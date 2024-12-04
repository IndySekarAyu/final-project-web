@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{ url('panel/materitambah') }}">Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Nama Kursus</th>
                                            <th>Deskripsi</th>
                                            <th>File</th>
                                            <th>Created By</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach ($materi as $row)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $row->judul }}</td>
                                                <td>{{ $row->namakursus }}</td>
                                                <td>{{ $row->deskripsi }}</td>
                                                <td>
                                                    @if (!empty($row->file))
                                                        <a href="{{ url('file/' . $row->file) }}" target="_blank"
                                                            class="btn btn-primary">Lihat File</a>
                                                    @else
                                                        File Tidak Ada
                                                    @endif
                                                </td>
                                                <td>{{ $row->nama }}</td>
                                                <td>
                                                    <a class="btn btn-primary m-1"
                                                        href="{{ url('panel/materiedit/' . $row->idmateri) }}">Edit</a>
                                                    <a class="btn btn-danger bdel m-1"
                                                        href="{{ url('panel/materihapus/' . $row->idmateri) }}">Hapus</a>
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
@endsection
