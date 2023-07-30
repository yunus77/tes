@extends('layouts.app')

@section('title', 'Absensi')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <p class="text-muted">
                <i class="fa fa-home px-1"></i> Home
                <i class="fa fa-angle-right px-2"></i> Absensi
            </p>
            <div class="d-flex pb-2"> 
                <div class="">
                    <form action="{{ route('absensi.index') }}" class="search-form" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{request()->search}}">
                            <button class="btn btn-outline-primary" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="ms-auto">
                    <a class="btn btn-success" href="{{ route('absensi.create') }}"> 
                        <span class="fa fa-plus"></span> Impor Data Absensi
                    </a>     
                </div>
            </div>

            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>                    
                            <th class="nomor-urut">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Info</th>
                            <th>Jam Kerja</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Kerja</th>
                            <th>Jam Lebih</th> 
                            <th>Lembur</th>   
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($absensi as $datae)
                        @php
                            $exp = explode(":",$datae->selisih);
                            $is_jam = (intval($exp[0]) != 0) ? intval($exp[0])." Jam" : "";
                            $is_menit = (intval($exp[1]) != 0) ? intval($exp[1])." menit" : "";
                        @endphp
                        <tr @if($datae->info == "MASUK") class="" @else class="table-danger" @endif>
                            <td class="tablecenter nomor-urut">{{ ++$i }}</td>
                            <td class="tablecenter">{{ $datae->nik }}</td>
                            <td class="tableleft">{{ $datae->nama }}</td>
                            <td class="tablecenter">{{ $datae->tgl }}</td>
                            <td class="tablecenter">{{ $datae->info }}</td>
                            <td class="tablecenter">{{ ($datae->info == "MASUK") ? "08:00 - 17:00" : "-" }}</td>
                            <td class="tablecenter">{{ $datae->masuk }}</td>
                            <td class="tablecenter">{{ $datae->pulang }}</td>
                            <td class="tablecenter">{{ $datae->ct }}</td>
                            <td class="tablecenter">{{ $is_jam }} {{ $is_menit }}</td>
                            <td class="tablecenter">{{ ($datae->lembur != 0) ? $datae->lembur ." Jam" : "" }}</td>
                            <td class="tablecenter">
                                @if (Auth::user()->username == "staff")
                                    <form action="{{ route('absensi.destroy',$datae->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')                                                
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="fa fa-times"></span> Delete</button>
                                    </form>
                                @endif    
                            </td>                   
                        </tr>
                    @endforeach
                    </tbody>
                </table>                    
            </div>            
                        
            <div class="pt-2 ps-2">
                {!! $absensi->links() !!}
            </div>

        </div>
    </div>

@endsection