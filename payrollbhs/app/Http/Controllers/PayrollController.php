<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request; 
use DateTime;
use PDF;
use DB;

class PayrollController extends Controller
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
        $payroll = Payroll::search()
                    ->selectRaw('gaji.*, karyawan.nama')
                    ->leftjoin('karyawan', 'karyawan.nik', '=', 'gaji.nik')
                    ->orderby('gaji.nik')
                    ->orderby('gaji.tahun')
                    ->orderby('gaji.bulan')
                    ->paginate(35)->appends(['search' => $search]);
                                     
        return view('payroll.index',compact('payroll'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }
    
    public function show($idx)
    {
        $payroll = Payroll::selectRaw('gaji.*, karyawan.nama, karyawan.jabatan')
                    ->leftjoin('karyawan', 'karyawan.nik', '=', 'gaji.nik')
                    ->where('gaji.id', $idx)->first()->toArray();
        // return view('payroll.show',compact('payroll'));

        $data = ['payroll' => $payroll]; 
        $pdf = PDF::loadView('payroll.show', $data);
        // download PDF file with download method
        return $pdf->download('slip-gaji.pdf');
    }

    public function store(Request $request)
    {
        $idx = $request->input('idx');
        $vilidat = DB::table('gaji')->where('id', $idx)
                        ->update(['valid' => 'Y']);

        $getdata = DB::table('gaji')->select('nik','tahun','bulan')->where('id', $idx)->first();        
        $vilidate = DB::table('absensi_jadi')->where('nik', $getdata->nik)->whereRaw("YEAR(tgl)='$getdata->tahun' AND MONTH(tgl)='$getdata->bulan'")
                        ->update(['valid' => 'Y']);

        if($vilidate){
            return redirect()->route('payroll.index')
                             ->with('success','Validasi successfully.');                   
        }else{   
            return redirect()->back()
                            ->withErrors(['error','Gagal Validasi, Silahkan di coba lagi.']);
        }
    }

    public function destroy($payroll)
    {                    
        Payroll::where('id', $payroll)->delete();
        return redirect()->route('payroll.index')
                        ->with('success','payroll deleted successfully');
    }
}
