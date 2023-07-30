@extends('layouts.app')

@section('title', 'Detail Karyawan')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Detail Karyawan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('karyawan.index') }}"> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NIK:</strong>
                {{ $karyawan->nik }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama:</strong>
                {{ $karyawan->nama }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tempat & Tgl lahir:</strong>
                {{ $karyawan->tempat_lahir }} , {{ $karyawan->tgl_lahir }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Kelamin:</strong>
                {{ ($karyawan->gender == "L") ? "Laki - Laki" : "Perempuan" }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jabatan:</strong>
                {{ $karyawan->jabatan }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $karyawan->status }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Gaji Pokok:</strong>
                {{ number_format($karyawan->gaji_pokok ,0, ',', '.') }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tunjangan:</strong>
                {{ number_format($karyawan->tunjangan ,0, ',', '.') }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tgl masuk kerja:</strong>
                {{ $karyawan->tgl_masuk }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>BPJS:</strong>
                {{ ($karyawan->bpjs == "Y") ? "Ya" : "Tidak" }}
            </div>
        </div>
    </div>
@endsection