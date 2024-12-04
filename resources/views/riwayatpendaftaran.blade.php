@extends('layout')

@section('content')
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Riwayat Pendaftaran</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Pendaftaran</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid my-5 pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- Tabel Riwayat Pendaftaran -->
                    <div class="card border-0 shadow-lg rounded-lg p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                        <h2 class="text-center mb-4">Daftar Riwayat Pendaftaran Kursus</h2>
                        <table id="table" class="display table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kursus</th>
                                    <th>Nama Guru</th>
                                    <th>Tanggal Pendaftaran</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendaftaran as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->namakursus }}</td>
                                        <td>{{ $item->namaguru }}</td>
                                        <td>{{ tanggal($item->tanggalpendaftaran) }}</td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $pendaftaran->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
