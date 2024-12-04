@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ url('panel/kursustambahsimpan') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nama Guru</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select name="idguru" id="idguru" class="form-control">
                                            <option value="" selected disabled>Pilih Guru</option>
                                            @foreach ($guru as $row)
                                                <option value="{{ $row->idguru }}">{{ $row->namaguru }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nama Kursus</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control" name="namakursus" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-12 col-md-2 col-form-label">Deskripsi Kursus</label>
                                    <div class="col-sm-12 col-md-10">
                                        <textarea rows="5" class="form-control" name="deskripsikursus" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Tanggl Mulai</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="date" class="form-control" name="tanggalawal" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Tanggl Selesai</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="date" class="form-control" name="tanggalakhir" required>
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
