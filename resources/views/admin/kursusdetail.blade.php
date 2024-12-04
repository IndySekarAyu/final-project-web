@extends('admin/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">Peserta Kursus</h3>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{ url('panel/kursusdetailtambah/' . $idkursus) }}">Tambah
                                Data</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Lengkap</th>
                                            <th>Nama Kursus</th>
                                            <th>Nama Guru</th>
                                            <th>Deskripsi Kursus</th>
                                            <th>Tanggal Pendaftaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach ($pendaftaran as $row)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $row->namalengkap }}</td>
                                                <td>{{ $row->namakursus }}</td>
                                                <td>{{ $row->namaguru }}</td>
                                                <td>{{ $row->deskripsikursus }}</td>
                                                <td>{{ $row->tanggalpendaftaran }}</td>
                                                <td>
                                                    <a class="btn btn-danger bdel m-1"
                                                        href="{{ url('panel/kursusdetailhapus/' . $row->idpendaftaran) }}">Hapus</a>
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
