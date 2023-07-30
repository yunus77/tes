@extends('layouts.app')

@section('title', 'Import Data Absensi')

@section('content')

    @php
        $bulan = array ('KS', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    @endphp
    
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mainbox">
                <div class="card-header">
                    <div class="pull-left">
                    Import Data Absensi Langsung dari REST API
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info" href="{{ route('absensi.index') }}"><span class="fa fa-chevron-left"></span> Back</a>
                    </div>
                </div>
                <div class="card-body mainbox-form">            

                    <form id="myform" action="{{ route('absensi.store') }}" method="POST">
                        @csrf
                        
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tahun</label>
                            <div class="col-9">
                                <select class="form-select" name="tahun" required>
                                    <option value="{{ date('Y')-1 }}">{{ date('Y')-1 }}</option>
                                    <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                                    <option value="{{ date('Y')+1 }}">{{ date('Y')+1 }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Bulan</label>
                            <div class="col-9">
                                <select class="form-select" name="bulan" required>
                                    <option disable selected hidden></option>
                                    @foreach($bulan as $nobulan => $namabulan)
                                        @if($nobulan!=0)
                                            <option value="{{ $nobulan }}" @if(date('m') == $nobulan) selected @endif>{{ $namabulan }}</option>
                                        @endif                                       
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Karyawan</label>
                            <div class="col-9">
                                <select class="form-select" name="karyawan">
                                    <option value="all">Semua Karyawan</option>
                                    @foreach($karyawan as $kary)
                                        <option value="{{ $kary->nik }}">{{ $kary->nik.' - '.$kary->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="p-125 row">
                            <label class="col-3 col-form-label">Tgl Start</label>
                            <div class="col-9">
                                <div class="input-group">
                                    <input type="text" name="date1" class="form-control start-date" placeholder="Tgl Start" required/>
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tgl End</label>
                            <div class="col-9">
                                <div class="input-group">                                    
                                    <input type="text" name="date2" class="form-control end-date" placeholder="Tgl End" required/>
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div> -->
                        
                        <div class="p-125 row">
                            <div class="col-9 offset-3">
                                <button type="submit" class="btn btn-success"> 
                                    <span class="fa fa-download"></span> Import
                                </button>
                                <span id="infoloading2" style="padding-bottom:5px;"></span>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive shadow-sm pt-4">
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
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @foreach ($absensi_jadi as $datae)
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
                    </tr>
                @endforeach
           
            </tbody>
        </table>                     
    </div>

@endsection