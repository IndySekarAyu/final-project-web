@extends('layout')

@section('content')
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">{{ $title }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('kursusdaftar') }}">Daftar Kursus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid my-5 pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-12 mb-5">
                    <!-- Card for Kursus Details -->
                    <div class="card border-0 shadow-lg rounded-lg p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                        <center>
                            <h2 class="mt-3">{{ $row->namakursus }}</h2>
                            <p><i class="fa fa-calendar"></i> {{ tanggal($row->tanggalawal) }} -
                                {{ tanggal($row->tanggalakhir) }}</p>
                            <p><i class="fa fa-user"></i> {{ $row->namaguru }}</p>
                        </center>
                        <br>
                        <!-- Kursus Description -->
                        <div class="row g-3">
                            <div class="col-md-12 col-12">
                                <p style="text-align: justify" class="mt-2 text-dark">
                                    {!! nl2br(e($row->deskripsikursus)) !!}
                                </p>
                            </div>
                        </div>
                        <!-- Add 'Daftar Kursus' button -->
                        @if (session('akuninternal'))
                            @if ($pendaftaran == 0)
                                <div class="text-center mt-4">
                                    <a href="{{ url('pendaftarankursus/' . $row->idkursus) }}"
                                        class="btn btn-success btn-lg">
                                        Daftar Kursus
                                    </a>
                                </div>
                            @else
                                {{-- tombol whatsapp nomor guru --}}
                                @php
                                    $formattedPhone = preg_replace('/^08/', '628', $row->notelp);
                                @endphp

                                <div class="text-center mt-4">
                                    <a href="https://wa.me/{{ $formattedPhone }}" target="_blank"
                                        class="btn btn-success btn-lg">
                                        Hubungi Guru
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center mt-4">
                                <a href="{{ url('pendaftarankursus/' . $row->idkursus) }}" class="btn btn-success btn-lg">
                                    Daftar Kursus
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Materi List Section -->
                <div class="col-md-12">
                    <h3 class="mb-4 mt-5">Daftar Materi Kursus</h3>
                    @if ($materi->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Belum ada materi untuk kursus ini.
                        </div>
                    @else
                        <div class="list-group">
                            @foreach ($materi as $item)
                                <a href="{{ url('materidetail/' . $item->idmateri) }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span>{{ $item->judul }}</span>
                                    <span class="badge bg-primary rounded-pill">{{ $item->deskripsi }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
