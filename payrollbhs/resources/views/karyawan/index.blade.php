@extends('layouts.app')

@section('title', 'Karyawan')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <p class="text-muted">
                <i class="fa fa-home px-1"></i> Home
                <i class="fa fa-angle-right px-2"></i> Absensi
            </p>
            <div class="d-flex pb-2"> 
                <div class="">
                    <form action="{{ route('karyawan.index') }}" class="search-form" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{request()->search}}">
                            <button class="btn btn-outline-primary" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="ms-auto">
                    @if (Auth::user()->username == "staff")
                        <a class="btn btn-success" href="{{ route('karyawan.create') }}"> 
                            <span class="fa fa-plus"></span> Tambah Karyawan
                        </a>    
                    @endif     
                </div>
            </div>

            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>                    
                            <th class="nomor-urut">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tempat</th>
                            <th>Tgl Lahir</th>
                            <th>Gender</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th> 
                            <th>Tgl Masuk</th>   
                            <th>BPJS</th>   
                            <th>Cetak</th>  
                            <th>Edit</th>  
                            <th>Del</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($karyawan as $datae)
                        <tr>
                            <td class="tablecenter nomor-urut">{{ ++$i }}</td>
                            <td class="tablecenter">{{ $datae->nik }}</td>
                            <td class="tableleft">{{ $datae->nama }}</td>
                            <td class="tableleft">{{ $datae->tempat_lahir }}</td>
                            <td class="tablecenter">{{ $datae->tgl_lahir }}</td>
                            <td class="tableleft">{{ ($datae->gender == "L") ? "Laki - Laki" : "Perempuan" }}</td>
                            <td class="tablecenter">{{ $datae->jabatan }}</td>
                            <td class="tablecenter">{{ $datae->status }}</td>
                            <td class="tablecenter">{{ number_format($datae->gaji_pokok ,0, ',', '.') }}</td> 
                            <td class="tablecenter">{{ number_format($datae->tunjangan ,0, ',', '.') }}</td> 
                            <td class="tablecenter">{{ $datae->tgl_masuk }}</td>
                            <td class="tableleft">{{ ($datae->bpjs == "Y") ? "Ya" : "Tidak" }}</td>                              
                            <td class="tablecenter">   
                                @if (Auth::user()->username == "staff")
                                    <a class="btn btn-sm btn-info" href="{{ route('karyawan.show',$datae->id) }}"><span class="fa fa-print"></span> Print</a>
                                @endif    
                            </td>  
                            <td class="tablecenter">   
                                @if (Auth::user()->username == "staff")          
                                    <a class="btn btn-sm btn-primary" href="{{ route('karyawan.edit',$datae->id) }}"><span class="fa fa-pencil"></span> Edit</a> 
                                @endif    
                            </td>  
                            <td class="tablecenter">   
                                @if (Auth::user()->username == "staff")
                                    <form action="{{ route('karyawan.destroy',$datae->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')                                                
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="fa fa-times"></span> Del</button>
                                    </form>
                                @endif    
                            </td>                   
                        </tr>
                    @endforeach
                    </tbody>
                </table>                    
            </div>            
                        
            <div class="pt-2 ps-2">
                {!! $karyawan->links() !!}
            </div>

        </div>
    </div>

@endsection