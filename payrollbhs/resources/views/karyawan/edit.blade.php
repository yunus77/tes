@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mainbox">
                <div class="card-header">
                    <div class="pull-left">
                        Edit Karyawan
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info" href="{{ route('karyawan.index') }}"><span class="fa fa-chevron-left"></span> Back</a>
                    </div>
                </div>
                <div class="card-body mainbox-form">            

                    <form id="myform" class="row p-0" action="{{ route('karyawan.update',$karyawan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">NIK</label>
                            <div class="col-9">
                                <input class="form-control" type="text"name="nik" value="{{ $karyawan->nik }}" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Nama</label>
                            <div class="col-9">
                                <input class="form-control" type="text"name="nama" value="{{ $karyawan->nama }}" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tempat Lahir</label>
                            <div class="col-9">
                                <input class="form-control" type="text"name="tempat_lahir" value="{{ $karyawan->tempat_lahir }}" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tgl Lahir</label>
                            <div class="col-9">
                                <div class="input-group">                                    
                                    <input type="text" name="tgl_lahir" class="form-control start-date pe-3" value="{{ $karyawan->tgl_lahir }}" required/>
                                    <span class="input-group-text">
                                    <i class="fa fa-calendar fa-fw text-muted"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-9">
                                <select class="form-select" name="gender" required>
                                    <option value="L" {{ $karyawan->gender=='L' ? 'selected' : ''}}>Laki - Laki</option>
                                    <option value="P" {{ $karyawan->gender=='P' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Jabatan</label>
                            <div class="col-9">
                                <select class="form-select" name="jabatan" required>
                                    <option value="supervisor" {{ $karyawan->jabatan=='supervisor' ? 'selected' : ''}}>Supervisor</option>
                                    <option value="staff" {{ $karyawan->jabatan=='staff' ? 'selected' : ''}}>Staff</option>
                                    <option value="ob" {{ $karyawan->jabatan=='ob' ? 'selected' : ''}}>OB</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Status Kerja</label>
                            <div class="col-9">
                                <select class="form-select" name="status" required>
                                    <option value="TETAP" {{ $karyawan->status=='TETAP' ? 'selected' : ''}}>TETAP</option>
                                    <option value="KONTRAK" {{ $karyawan->status=='KONTRAK' ? 'selected' : ''}}>KONTRAK</option>
                                    <option value="HL" {{ $karyawan->status=='HL' ? 'selected' : ''}}>HL</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Gaji Pokok</label>
                            <div class="col-9">
                                <input class="form-control" type="number" step="any" name="gaji_pokok" value="{{ $karyawan->gaji_pokok }}" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tunjangan</label>
                            <div class="col-9">
                                <input class="form-control" type="number" step="any" name="tunjangan" value="{{ $karyawan->tunjangan }}" required>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Tgl Masuk Kerja</label>
                            <div class="col-9">
                                <div class="input-group">                                    
                                    <input type="text" name="tgl_masuk" class="form-control start-date pe-3" value="{{ $karyawan->tgl_masuk }}" required/>
                                    <span class="input-group-text">
                                    <i class="fa fa-calendar fa-fw text-muted"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <label class="col-3 col-form-label">Pakai BPJS</label>
                            <div class="col-9">
                                <select class="form-select" name="bpjs" required>
                                    <option disable selected hidden></option>
                                    <option value="Y" {{ $karyawan->bpjs=='Y' ? 'selected' : ''}}>Ya</option>
                                    <option value="N" {{ $karyawan->bpjs=='N' ? 'selected' : ''}}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-125 row">
                            <div class="col-9 offset-3">
                                <button type="submit" class="btn btn-success"> 
                                    <span class="fa fa-save"></span> Simpan
                                </button>
                                <span id="infoloading2" style="padding-bottom:5px;"></span>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection