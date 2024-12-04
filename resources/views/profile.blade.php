@extends('layout')

@section('content')
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Profil Pengguna</h1>
        </div>
    </div>

    <div class="container-fluid my-5 pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Tampilkan pesan sukses jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Edit Profil -->
                    <div class="card border-0 shadow-lg rounded-lg p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                        <h4>Informasi Profil</h4>
                        <form action="{{ url('profileupdate') }}" method="POST">
                            @csrf

                            <!-- Nama -->
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ old('nama', $profile->nama) }}" required>
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                    value="{{ old('alamat', $profile->alamat) }}" required>
                                @error('alamat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="tempatlahir">Tempat Lahir</label>
                                <input type="text" name="tempatlahir" id="tempatlahir" class="form-control"
                                    value="{{ old('tempatlahir', $profile->tempatlahir) }}" required>
                                @error('tempatlahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="tanggallahir">Tanggal Lahir</label>
                                <input type="date" name="tanggallahir" id="tanggallahir" class="form-control"
                                    value="{{ old('tanggallahir', $profile->tanggallahir) }}" required>
                                @error('tanggallahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $profile->email) }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- No. Telp --}}
                            <div class="form-group mt-3">
                                <label for="notelp">No. Telp</label>
                                <input type="text" name="notelp" id="notelp" class="form-control"
                                    value="{{ old('notelp', $profile->notelp) }}" required>
                                @error('notelp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group mt-3">
                                <label for="password">Password Baru</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="form-group mt-3">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-lg mt-4">Perbarui Profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
