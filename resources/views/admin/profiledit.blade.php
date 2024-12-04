@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ url('panel/profileditsimpan') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nama</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $row->nama }}" required>
                                        @error('nama')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if (session('akuninternal')->level != 'Admin')
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select name="jeniskelamin" id="jeniskelamin" class="form-control">
                                                <option value="Laki-laki"
                                                    {{ $row->jeniskelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ $row->jeniskelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                            @error('jeniskelamin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input type="text" class="form-control" name="alamat"
                                                value="{{ $row->alamat }}" required>
                                            @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-2 col-form-label">No Telp</label>
                                        <div class="col-sm-12 col-md-10">
                                            <input type="text" class="form-control" name="notelp"
                                                value="{{ $row->notelp }}" required>
                                            @error('notelp')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $row->email }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control" name="password"
                                            value="{{ $row->password }}" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right" name="simpan">Simpan</button>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
