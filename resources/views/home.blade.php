@extends('layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a class="btn btn-primary mb-3" href="{{ url('admin/karyatambah') }}">Tambah Data</a>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Judul</th>
                                                    <th>Tanggal</th>
                                                    <th>Deskripsi</th>
                                                    <th>Foto</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                ?>
                                                @foreach ($karya as $row)
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $row->judul }}</td>
                                                        <td>{{ $row->tanggal }}</td>
                                                        <td>{{ $row->deskripsi }}</td>
                                                        <td>{{ $row->foto }}</td>
                                                        <td>
                                                            <a class="btn btn-primary" href="#">Edit</a>
                                                            <a class="btn btn-danger" href="#">Hapus</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $no++;
                                                    ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
