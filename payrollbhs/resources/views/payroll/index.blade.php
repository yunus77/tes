@extends('layouts.app')

@section('title', 'Payroll')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <p class="text-muted">
                <i class="fa fa-home px-1"></i> Home
                <i class="fa fa-angle-right px-2"></i> Payroll
            </p>
            <div class="d-flex pb-2"> 
                <div class="">
                    <form action="{{ route('payroll.index') }}" class="search-form" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{request()->search}}">
                            <button class="btn btn-outline-primary" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="ms-auto">   
                </div>
            </div>
            
            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-hover m-0">
                    <thead>
                        <tr>
                            <th class="nomor-urut">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Lama Kerja</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Hari Efektif</th>
                            <th>Masuk Kerja</th>
                            <th>Bolos</th> 
                            <th>Lembur</th> 
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Insentif</th>
                            <th>Upah Lembur</th> 
                            <th>NPWP</th> 
                            <th>BPJS</th> 
                            <th>Total Gaji</th> 
                            <th>Valid</th> 
                            <th>Export</th> 
                            <th>Hapus</th> 
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($payroll as $datae)
                        <tr>
                            <td class="tablecenter nomor-urut">{{ ++$i }}</td>
                            <td class="tablecenter">{{ $datae->nik }}</td>
                            <td class="tableleft">{{ $datae->nama }}</td>
                            <td class="tableleft">{{ $datae->status }}</td>
                            <td class="tablecenter">{{ $datae->lama_kerja }} Thn</td>
                            <td class="tablecenter">{{ $datae->tahun }}</td>
                            <td class="tablecenter">{{ $datae->bulan }}</td>
                            <td class="tablecenter">{{ $datae->hari_efektif }}</td>
                            <td class="tablecenter">{{ $datae->hari_kerja }}</td>
                            <td class="tablecenter">{{ ($datae->bolos != 0) ? $datae->bolos." Hari" : "-" }}</td>
                            <td class="tablecenter">{{ ($datae->jam_lembur != 0) ? $datae->jam_lembur ." Jam" : "-" }}</td>
                            <td class="tablecenter">{{ number_format($datae->gaji_pokok ,0, ',', '.') }}</td> 
                            <td class="tablecenter">{{ number_format($datae->tunjangan ,0, ',', '.') }}</td> 
                            <td class="tablecenter">{{ number_format($datae->insentif ,0, ',', '.') }}</td> 
                            <td class="tablecenter">{{ number_format($datae->upah_lembur ,0, ',', '.') }}</td> 
                            <td class="tablecenter">{{ number_format($datae->npwp ,0, ',', '.') }}</td> 
                            <td class="tablecenter">{{ number_format($datae->bpjs ,0, ',', '.') }}</td> 
                            <td class="tablecenter">{{ number_format($datae->total_gaji ,0, ',', '.') }}</td>
                            <td class="tablecenter">
                                @if ($datae->valid=="Y")
                                    <span class="text-success fa fa-check" data-bs-toggle="tooltip" title="sudah di Validasi" style="font-size:18px;"></span>
                                @else 
                                    @if (Auth::user()->username == "supervisor")
                                        <form action="{{ route('payroll.store') }}" method="POST">
                                            @csrf       
                                            <input type="hidden" name="idx" value="{{ $datae->id }}">                                    
                                            <button type="submit" class="btn btn-sm btn-success validasi"><span class="fa fa-check"></span></button>
                                        </form>
                                    @endif
                                @endif
                            </td>  
                            <td class="tablecenter">   
                                @if (Auth::user()->username == "staff")
                                    <a class="btn btn-sm btn-warning" href="{{ route('payroll.show',$datae->id) }}"><span class="fa fa-file-pdf-o"></span> Pdf</a>
                                @endif    
                            </td>  
                            <td class="tablecenter">
                                @if (Auth::user()->username == "staff")
                                    <form action="{{ route('payroll.destroy',$datae->id) }}" method="POST">
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
                {!! $payroll->links() !!}
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".validasi").submit(function(e) {
                console.log("dd");
                $(this).html('<span class="spinner-border spinner-border-sm"></span>'); 
            });
        });
    </script>
@endsection