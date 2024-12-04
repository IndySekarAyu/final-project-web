@extends('layout')

@section('content')
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Detail Materi</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('kursusdaftar') }}">Daftar Kursus</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('kursusdetail/' . $materi->idkursus) }}">Detail Kursus</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $materi->judul }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid my-5 pt-5">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-12 mb-5">
                    <!-- Card for Materi Details -->
                    <div class="card border-0 shadow-lg rounded-lg p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
                        <center>
                            <h2 class="mt-3">{{ $materi->judul }}</h2>
                        </center>
                        <br>
                        <!-- Materi Description -->
                        <div class="row g-3">
                            <div class="col-md-12 col-12">
                                <p style="text-align: justify" class="mt-2 text-dark">
                                    {!! nl2br(e($materi->deskripsi)) !!}
                                </p>
                            </div>
                        </div>

                        <!-- Materi File or Link -->
                        @if ($materi->file)
                            <div class="mt-4">
                                @php
                                    $fileExtension = pathinfo($materi->file, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                    <!-- Display Image -->
                                    <h5><strong>Gambar Materi:</strong></h5>
                                    <img src="{{ asset('file/' . $materi->file) }}" class="img-fluid"
                                        alt="{{ $materi->judul }}">
                                @elseif (in_array($fileExtension, ['mp4', 'mov', 'avi', 'webm', 'mkv']))
                                    <!-- Display Video -->
                                    <h5><strong>Video Materi:</strong></h5>
                                    <video width="100%" controls>
                                        <source src="{{ asset('file/' . $materi->file) }}"
                                            type="video/{{ $fileExtension }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @elseif (in_array($fileExtension, ['pdf', 'doc', 'docx', 'ppt', 'txt']))
                                    <!-- Display Download Link for Documents -->
                                    <h5><strong>Download Materi:</strong></h5>
                                    <a href="{{ asset('file/' . $materi->file) }}" class="btn btn-primary btn-lg" download>
                                        Download Materi ({{ strtoupper($fileExtension) }})
                                    </a>
                                @else
                                    <!-- Display Default Download Link for Other Files -->
                                    <h5><strong>Download Materi:</strong></h5>
                                    <a href="{{ asset('file/' . $materi->file) }}" class="btn btn-primary btn-lg" download>
                                        Download Materi
                                    </a>
                                @endif
                            </div> 
                        @endif

                        <!-- Status Section -->
                        @if ($progress_materi && $progress_materi->markasdone == 'Selesai')
                            {{-- <div class="mt-4">
                                <button class="btn btn-success btn-lg" disabled>
                                    Selesai
                                </button>
                            </div> --}}
                        @else
                            <div class="mt-4">
                                <h5><strong>Status:</strong></h5>
                                <form action="{{ url('updatemateristatus/' . $materi->idmateri) }}" method="POST">
                                    @csrf

                                    <!-- Dropdown for Status -->
                                    <div class="form-group">
                                        <label for="status">Pilih Status</label>
                                        <select name="status" id="status" class="form-control">
                                            @foreach (range(0, 100, 10) as $percentage)
                                                <option value="{{ $percentage }}%"
                                                    @if (!empty($progress_materi) && $progress_materi->status == $percentage . '%') selected @endif>
                                                    {{ $percentage }}%
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-warning btn-lg mt-3">
                                        Update Status
                                    </button>
                                </form>
                            </div>
                        @endif

                        <!-- Mark as Done Button -->
                        @if ($progress_materi && $progress_materi->markasdone == 'Selesai')
                            <div class="mt-4">
                                <button class="btn btn-success btn-lg" disabled>
                                    Selesai
                                </button>
                            </div>
                        @else
                            <div class="mt-4">
                                <form action="{{ url('markasdone', $materi->idmateri) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-lg">
                                        Mark as Done
                                    </button>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
