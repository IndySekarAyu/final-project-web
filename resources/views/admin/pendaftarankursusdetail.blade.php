@extends('admin/layout')

@section('content')
    <div class="content-body">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">Detail Pendaftaran Kursus</h3>

                    <div class="card shadow-lg rounded-lg">
                        <div class="card-body">
                            <!-- Card for Personal Information -->
                            <div class="card mb-4 bg-light rounded">
                                <div class="card-header">
                                    <strong>Informasi Pribadi</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><strong>Nama Lengkap:</strong></h5>
                                            <p class="text-muted">{{ $pendaftaran->namalengkap }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><strong>Tempat Lahir:</strong></h5>
                                            <p class="text-muted">{{ $pendaftaran->tempatlahir }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><strong>Tanggal Lahir:</strong></h5>
                                            <p class="text-muted">{{ tanggal($pendaftaran->tanggallahir) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><strong>Nomor HP:</strong></h5>
                                            <p class="text-muted">{{ $pendaftaran->nohp }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5><strong>Alamat:</strong></h5>
                                            <p class="text-muted">{{ $pendaftaran->alamat }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card for Kursus Information -->
                            <div class="card mb-4 bg-light rounded">
                                <div class="card-header">
                                    <strong>Informasi Kursus</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><strong>Nama Kursus:</strong></h5>
                                            <p class="text-muted">{{ $pendaftaran->namakursus }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><strong>Nama Guru:</strong></h5>
                                            <p class="text-muted">{{ $pendaftaran->namaguru }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><strong>Deskripsi Kursus:</strong></h5>
                                            <p class="text-muted">{{ $pendaftaran->deskripsikursus }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><strong>Tanggal Mulai:</strong></h5>
                                            <p class="text-muted">
                                                {{ \Carbon\Carbon::parse($pendaftaran->tanggalawal)->locale('id')->isoFormat('D MMMM YYYY') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5><strong>Tanggal Selesai:</strong></h5>
                                            <p class="text-muted">
                                                {{ \Carbon\Carbon::parse($pendaftaran->tanggalakhir)->locale('id')->isoFormat('D MMMM YYYY') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card for Pendaftaran Information -->
                            <div class="card mb-4 bg-light rounded">
                                <div class="card-header">
                                    <strong>Informasi Pendaftaran</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><strong>Tanggal Pendaftaran:</strong></h5>
                                            <p class="text-muted">{{ tanggal($pendaftaran->tanggalpendaftaran) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><strong>Status Pendaftaran:</strong></h5>
                                            <p
                                                class="badge
                                                @if ($pendaftaran->status == 1) bg-success
                                                @elseif ($pendaftaran->status == 2)
                                                    bg-danger
                                                @else
                                                    bg-warning @endif
                                                text-white">
                                                {{ $pendaftaran->status == 1 ? 'Diterima' : ($pendaftaran->status == 2 ? 'Ditolak' : 'Menunggu Konfirmasi') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Form untuk memilih status baru -->
                                    <form
                                        action="{{ url('panel/pendaftarankursusupdate/' . $pendaftaran->idpendaftaran) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group mt-4">
                                            <label for="status" class="form-label"><strong>Update Status
                                                    Pendaftaran</strong></label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="Menunggu Konfirmasi Admin"
                                                    @if ($pendaftaran->status == 'Menunggu Konfirmasi') selected @endif>
                                                    Menunggu Konfirmasi</option>
                                                <option value="Diterima" @if ($pendaftaran->status == 'Diterima') selected @endif>
                                                    Diterima</option>
                                                <option value="Ditolak" @if ($pendaftaran->status == 'Ditolak') selected @endif>
                                                    Ditolak</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Kembali ke halaman sebelumnya -->
                            {{-- <a href="{{ url('panel/pendaftarankursus') }}" class="btn btn-secondary mt-3">Kembali</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
