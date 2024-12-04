@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{ url('panel/siswatambah') }}">Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>No. Telp</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach ($siswa as $row)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $row->namasiswa }}</td>
                                                <td>{{ $row->notelp }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>
                                                    <a class="btn btn-primary m-1"
                                                        href="{{ url('panel/siswaedit/' . $row->idsiswa) }}">Edit</a>
                                                    <a class="btn btn-danger bdel m-1"
                                                        href="{{ url('panel/siswahapus/' . $row->idsiswa) }}">Hapus</a>
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
