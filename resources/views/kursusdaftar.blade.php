@extends('layout')
@section('content')
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">{{ $title }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-fluid my-5 pt-5">
    <div class="container pt-5">
        {{-- Form Pencarian --}}
        <form method="post" action="{{ url('kursusdaftarcari') }}">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 col-4">
                        <input type="text" name="keyword" class="form-control" placeholder="Masukkan keyword pencarian"
                            value="{{ $keyword }}">
                    </div>
                    <div class="col-md-4 col-4">
                        <button type="submit" class="btn btn-success">Cari</button>
                    </div>
                </div>
            </div>
        </form>

        {{-- Daftar Kursus dalam Bentuk Tombol --}}
        <div class="row mt-5 justify-content-center">
            @if ($hitung >= 1)
            @foreach ($kursus as $row)
            <div class="col-md-4 col-12 mb-4 text-center">
                <a href="{{ url('kursusdetail/' . $row->idkursus) }}" class="btn btn-primary w-100 py-3">
                    {{ $row->namakursus }}
                </a>
            </div>
            @endforeach
            @else
            <div class="col-md-12 text-center">
                <div class="card border rounded p-4 wow fadeInUp" data-wow-delay="0.5s">
                    <h5 class="mt-3">Keyword yang Anda cari tidak ditemukan</h5>
                </div>
            </div>
            @endif
        </div>

        {{-- Pagination --}}
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                {{ $kursus->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection