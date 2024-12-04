@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ url('panel/materieditsimpan/' . $row->idmateri) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nama Kursus</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select name="idkursus" id="idkursus" class="form-control">
                                            <option value="" selected disabled>Pilih Kursus</option>
                                            @foreach ($kursus as $value)
                                                <option value="{{ $value->idkursus }}"
                                                    {{ $value->idkursus == $row->idkursus ? 'selected' : '' }}>
                                                    {{ $value->namakursus }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Judul</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control" name="judul"
                                            value="{{ $row->judul }}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-12 col-md-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-12 col-md-10">
                                        <textarea rows="5" class="form-control" name="deskripsi" required>{{ $row->deskripsi }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">File</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="file" class="form-control" name="file">
                                        <small>* Kosongkan jika tidak ingin diubah</small>
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
