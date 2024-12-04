@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            @if (session('akuninternal')->level == 'Admin')
                                <a class="btn btn-primary mb-3" href="{{ url('panel/kursustambah') }}">Tambah Data</a>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kursus</th>
                                            <th>Nama Guru</th>
                                            <th>Deskripsi Kursus</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach ($kursus as $row)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $row->namakursus }}</td>
                                                <td>{{ $row->namaguru }}</td>
                                                <td>{{ $row->deskripsikursus }}</td>
                                                <td>{{ $row->tanggalawal }}</td>
                                                <td>{{ $row->tanggalakhir }}</td>
                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ url('panel/kursusdetail/' . $row->idkursus) }}">Detail</a>
                                                    @if (session('akuninternal')->level == 'Admin')
                                                        <a class="btn btn-primary m-1"
                                                            href="{{ url('panel/kursusedit/' . $row->idkursus) }}">Edit</a>
                                                        <a class="btn btn-danger bdel m-1"
                                                            href="{{ url('panel/kursushapus/' . $row->idkursus) }}">Hapus</a>
                                                    @endif
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
