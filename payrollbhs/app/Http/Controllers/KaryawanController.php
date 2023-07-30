<?php
    
namespace App\Http\Controllers;
    
use App\Models\Karyawan;
use Illuminate\Http\Request;
use DB;
    
class KaryawanController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->search;  
        $karyawan =Karyawan::search()
                    ->paginate(35)->appends(['search' => $search]);
                                     
        return view('karyawan.index',compact('karyawan'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nik' => 'required',
            'nama' => 'required',
            'status' => 'required',
            'bpjs' => 'required',
        ]);
    
        Karyawan::create($request->all());
    
        return redirect()->route('karyawan.index')
                        ->with('success','karyawan created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show',compact('karyawan'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit',compact('karyawan'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        request()->validate([
            'nik' => 'required',
            'nama' => 'required',
            'status' => 'required',
            'bpjs' => 'required',
        ]);
    
        $karyawan->update($request->all());
    
        return redirect()->route('karyawan.index')
                        ->with('success','Karyawan updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
    
        return redirect()->route('karyawan.index')
                        ->with('success','Karyawan deleted successfully');
    }
}