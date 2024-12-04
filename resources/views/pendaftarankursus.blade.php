@extends('layout')

@section('content')
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Pendaftaran Kursus</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('kursusdaftar') }}">Daftar Kursus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pendaftaran Kursus</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid my-5 pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Kursus Info -->
                    <div class="card border-0 shadow-lg rounded-lg p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                        <h2 class="text-center mb-4">Detail Kursus: {{ $kursus->namakursus }}</h2>
                        <p><i class="fa fa-calendar"></i> {{ tanggal($kursus->tanggalawal) }} -
                            {{ tanggal($kursus->tanggalakhir) }}</p>
                        <p><i class="fa fa-user"></i> {{ $kursus->namaguru }}</p>
                    </div>
                    <br>

                    <!-- Pendaftaran Form -->
                    <div class="card border-0 shadow-lg rounded-lg p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                        <h3 class="text-center mb-4">Formulir Pendaftaran</h3>
                        <form method="POST" action="{{ url('prosespendaftarankursus') }}">
                            @csrf
                            <!-- Kursus ID -->
                            <input type="hidden" name="idkursus" value="{{ $kursus->idkursus }}">

                            <!-- Nama Lengkap -->
                            <div class="form-group mb-3">
                                <label for="namalengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="namalengkap" name="namalengkap" required
                                    placeholder="Masukkan nama lengkap">
                            </div>

                            <!-- Tempat Lahir -->
                            <div class="form-group mb-3">
                                <label for="tempatlahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" required
                                    placeholder="Masukkan tempat lahir">
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="form-group mb-3">
                                <label for="tanggallahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" required>
                            </div>

                            <!-- Alamat -->
                            <div class="form-group mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required
                                    placeholder="Masukkan alamat lengkap"></textarea>
                            </div>

                            <!-- Nomor HP -->
                            <div class="form-group mb-3">
                                <label for="nohp">Nomor HP</label>
                                <input type="text" class="form-control" id="nohp" name="nohp" required
                                    placeholder="Masukkan nomor HP">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg">Daftar Kursus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
