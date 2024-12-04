@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{ url('panel/gurutambah') }}">Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Guru</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>No. Telp</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach ($guru as $row)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $row->namaguru }}</td>
                                                <td>{{ $row->jeniskelamin }}</td>
                                                <td>{{ $row->alamat }}</td>
                                                <td>{{ $row->notelp }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>
                                                    <a class="btn btn-primary m-1"
                                                        href="{{ url('panel/guruedit/' . $row->idguru) }}">Edit</a>
                                                    <a class="btn btn-danger bdel m-1"
                                                        href="{{ url('panel/guruhapus/' . $row->idguru) }}">Hapus</a>
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
