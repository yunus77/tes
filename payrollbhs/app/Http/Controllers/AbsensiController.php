<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use DateTime;
use DB;

class AbsensiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = request()->search;  
        $absensi =Absensi::search()
                        ->selectRaw('absensi_jadi.*, karyawan.nama')
                        ->leftjoin('karyawan', 'karyawan.nik', '=', 'absensi_jadi.nik')
                        ->orderby('absensi_jadi.nik')
                        ->orderby('absensi_jadi.tgl')
                        ->paginate(35)->appends(['search' => $search]);
                                     
        return view('absensi.index',compact('absensi'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function create()
    {
        $absensi_jadi = collect();
        $datagaji = collect();
        $karyawan =DB::table('karyawan')->orderBy('nik')->get();        
        return view('absensi.create',compact('karyawan','absensi_jadi','datagaji'));
    }
    
    public function store(Request $request)
    {
        $nik = $request->input('karyawan');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $keyapi = $bulan."-".$tahun."-".$nik;
        
        $response = Http::get('http://localhost:8086/payrollbhsapi/?id='.$keyapi);    
        $jsonData = $response->json();          
        // dd($jsonData);
        if($jsonData['status']==1){
            $quebatch = DB::table('batch')->insertGetId(['created_at' => now()]); 
            $batch = $quebatch;

            foreach ($jsonData['data'] as $datae) {
                $restdata['nik'] = $datae['nik'];
                $restdata['tgl'] = $datae['tgl'];
                $restdata['jam'] = $datae['jam'];
                $restdata['ct'] = $datae['ct'];
                $restdata['batch'] = $batch;
                $restdata['created_at'] = now();
                $inst = DB::table('absensix')->updateOrInsert([ 'nik' => $datae['nik'], 'tgl' => $datae['nik'] ], $restdata);
            }

            if($inst){
                $absensi = DB::table('absensix')
                        ->selectRaw('absensix.*, karyawan.nama, kalender_kerja.info, GROUP_CONCAT( CONCAT_WS("@", absensix.ct, absensix.jam) ) AS kode')
                        ->leftjoin('karyawan', 'karyawan.nik', '=', 'absensix.nik')
                        ->leftjoin('kalender_kerja', 'kalender_kerja.tgl', '=', 'absensix.tgl')
                        ->when($nik, function ($query, $nik) {
                            if($nik != 'all'){
                                return $query->where('absensix.nik', $nik);
                            }
                        })
                        ->whereRaw("YEAR(absensix.tgl)='$tahun' AND MONTH(absensix.tgl)='$bulan'")
                        ->groupBy('absensix.nik')
                        ->groupBy('absensix.tgl')
                        ->get();
                        
                foreach ($absensi as $datae) { 
                    $dataexp = explode(",", $datae->kode);
                    foreach ($dataexp as $exp){
                        $subexp = explode("@", $exp);
                        $pukul[$subexp[0]] = $subexp[1];
                    }
                    $jadwal_masuk = strtotime('08:00:00');
                    $jadwal_pulang = strtotime('17:00:00');
                    $masuk = strtotime($pukul["A"]);
                    $pulang = strtotime($pukul["B"]);

                    if ($datae->info != "MASUK"){
                        $kerja = "Lembur";
                        $diff = $pulang - $jadwal_masuk;
                    }else if ((($masuk >= $jadwal_masuk) && ($masuk <= $jadwal_pulang) ) || (($pulang >= $jadwal_masuk) && ($pulang <= $jadwal_pulang))){
                        $kerja = "Tidak Penuh";
                        $diff = $pulang - $jadwal_pulang;
                    }else{
                        $kerja = "Penuh";
                        $diff = $pulang - $jadwal_pulang;
                    }
                    
                    $jam  = floor($diff / (60 * 60));
                    $menit = $diff - $jam * (60 * 60);

                    $is_jam = ($jam != 0) ? $jam : "0";
                    $is_menit = (floor( $menit / 60 ) != 0) ? floor( $menit / 60 ) : "0";

                    /** - jam lembur = 1 sd 4 jam dikali 1, di atas 4 jam dikali 2 */
                    $jam_lembur = ($jam > 4) ? $jam*2 : $jam;
                    
                    $hasil['nik'] = $datae->nik;
                    $hasil['tgl'] = $datae->tgl;
                    $hasil['info'] = $datae->info;
                    $hasil['jadwal_masuk'] = '08:00:00';
                    $hasil['jadwal_pulang'] = '17:00:00';
                    $hasil['masuk'] = $pukul["A"];
                    $hasil['pulang'] = $pukul["B"];
                    $hasil['ct'] = $kerja;
                    $hasil['selisih'] = $is_jam.":".$is_menit;
                    $hasil['lembur'] = $jam_lembur;
                    $hasil['valid'] = "N";
                    $hasil['batch'] = $datae->batch;
                    $hasil['created_at'] = now();

                    $getdata = DB::table('absensi_jadi')->where('nik', $datae->nik)->where('tgl', $datae->tgl)->where('valid', "Y")->count(); 
                    if($getdata==0){
                        DB::table('absensi_jadi')->updateOrInsert(['nik' => $datae->nik, 'tgl' => $datae->tgl, 'valid' => "N"], $hasil);
                    }
                }

                $joinnya = DB::table('absensi_jadi')->selectRaw('COUNT(*) as hari_kerja, SUM(lembur) AS jam_lembur, nik')->whereRaw("YEAR(tgl)='$tahun' AND MONTH(tgl)='$bulan'")->groupBy('nik');  
                $datagaji =DB::table('karyawan')
                                ->selectRaw("karyawan.*, dt.hari_kerja, dt.jam_lembur, '$tahun' as tahun, '$bulan' as bulan, (SELECT COUNT(*) FROM kalender_kerja WHERE YEAR(tgl)='$tahun' AND MONTH(tgl)='$bulan' AND info='MASUK') as hari_efektif")
                                ->leftjoinSub($joinnya, 'dt', function ($join) {
                                    $join->on('karyawan.nik', '=', 'dt.nik');
                                })->get();

                foreach ($datagaji as $datae) { 
                    $tgl1 = new DateTime($datae->tgl_masuk );
                    $tgl2 = new DateTime(Date("Y-m-d"));
                    $jarak = $tgl2->diff($tgl1);
                    $lama_kerja = $jarak->y;
                    $insentif = ($lama_kerja > 0) ? ($lama_kerja*100000)+1000000 : 1000000;

                    $upah_lembur_perjam['TETAP'] = ($datae->gaji_pokok + $datae->tunjangan) / 173;
                    $upah_lembur_perjam['KONTRAK'] = ($datae->gaji_pokok + $datae->tunjangan) / 173;
                    $upah_lembur_perjam['HL'] = ($datae->gaji_pokok / 200);
                    $upah_lembur = $datae->jam_lembur * $upah_lembur_perjam[$datae->status];

                    $bolos = ($datae->hari_efektif > $datae->hari_kerja) ? $datae->hari_efektif-$datae->hari_kerja : 0;
                    $npwp = ($bolos*$datae->gaji_pokok) / 30;

                    $rumus_bpjs = ($datae->gaji_pokok + $datae->tunjangan) * (3/100);
                    $bpjs = ($datae->bpjs == "Y") ? $rumus_bpjs : 0;

                    $total_gaji = $datae->gaji_pokok + $datae->tunjangan + $insentif + $upah_lembur - $npwp - $bpjs;

                    $hasil2['nik'] = $datae->nik;
                    $hasil2['status'] = $datae->status;
                    $hasil2['lama_kerja'] = $lama_kerja;
                    $hasil2['has_bpjs'] = $datae->bpjs;
                    $hasil2['tahun'] = $tahun;
                    $hasil2['bulan'] = $bulan;
                    $hasil2['hari_efektif'] = $datae->hari_efektif;
                    $hasil2['hari_kerja'] = $datae->hari_kerja;
                    $hasil2['bolos'] = $bolos;
                    $hasil2['jam_lembur'] = $datae->jam_lembur;
                    $hasil2['gaji_pokok'] = $datae->gaji_pokok;
                    $hasil2['tunjangan'] = $datae->tunjangan;
                    $hasil2['insentif'] = $insentif;
                    $hasil2['upah_lembur'] = $upah_lembur;
                    $hasil2['npwp'] = $npwp;
                    $hasil2['bpjs'] = $bpjs;
                    $hasil2['total_gaji'] = $total_gaji;
                    $hasil2['valid'] = "N";
                    $hasil2['batch'] = "99";
                    $hasil2['created_at'] = now();
                    
                    $getdata = DB::table('gaji')
                                ->where('tahun', $datae->tahun)->where('bulan', $datae->bulan)
                                ->where('nik', $datae->nik)->where('valid', "Y")->count(); 
                    if($getdata==0){
                        DB::table('gaji')->updateOrInsert(['nik' => $datae->nik, 'tahun' => $datae->tahun, 'bulan' => $datae->bulan, 'valid' => "N"], $hasil2);
                    }
                }

                $karyawan =DB::table('karyawan')->orderBy('id')->get();
                $absensi_jadi =DB::table('absensi_jadi')
                                ->selectRaw('absensi_jadi.*, karyawan.nama')
                                ->leftjoin('karyawan', 'karyawan.nik', '=', 'absensi_jadi.nik')
                                ->when($nik, function ($query, $nik) {
                                    if($nik != 'all'){
                                        return $query->where('absensi.nik', $nik);
                                    }
                                })
                                ->whereRaw("YEAR(absensi_jadi.tgl)='$tahun' AND MONTH(absensi_jadi.tgl)='$bulan'")
                                ->orderby('absensi_jadi.nik')
                                ->orderby('absensi_jadi.tgl')
                                ->get();
            }

            return view('absensi.create',compact('karyawan','absensi_jadi'));
            // return redirect()->route('absensi.create')->with(compact('karyawan','absensi_jadi'))
            //                 ->with('success','Rest API successfully.'); 
            // return redirect()->route('absensi.create')
            //     ->with('success','Rest API successfully.');                   
        }else{   
            return redirect()->back()
                ->withErrors(['error','Gagal API, Silahkan di coba lagi.']);
        }
        
    }

    public function destroy($absensi)
    {                
        Absensi::where('id', $absensi)->delete();
        return redirect()->route('absensi.index')
                        ->with('success','absensi deleted successfully');
    }
}
