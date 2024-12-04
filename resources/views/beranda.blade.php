@extends('layout')
@section('content')
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('foto/home.png') }}" alt="Image" style="height: 700px">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <p>
                                    Selamat datang di</p>
                                <h1 class="display-1 mb-4 animated slideInDown">Web MyCourse
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4 align-items-end mb-4">
            <div class="col-lg-6 wow fadeInUp my-auto" data-wow-delay="0.1s">
                <img class="img-fluid rounded" src="{{ asset('foto/kursus2.webp') }}">
            </div>
            <div class="col-lg-6 wow fadeInUp my-auto" data-wow-delay="0.3s">
                <h1 class="display-5">Tentang Web Ini</h1>
                <p class="mb-4">Web ini bertujuan untuk memberikan platform bagi siswa yang ingin mengembangkan
                    keterampilan mereka melalui berbagai kursus yang tersedia. Kami menyediakan kursus dalam berbagai
                    bidang, mulai dari teknologi, seni, hingga pengembangan diri. Setiap kursus dilengkapi dengan materi
                    pembelajaran yang mudah diakses, serta pengajaran dari para ahli di bidangnya. Dengan adanya sistem
                    pembelajaran yang fleksibel dan berbasis online, siswa dapat belajar kapan saja dan di mana saja,
                    tanpa terbatas ruang dan waktu. Kursus kami juga mengutamakan kualitas pengajaran dan memberikan
                    kesempatan untuk mempraktikkan ilmu yang didapat melalui proyek nyata. Bergabunglah dengan kursus
                    kami untuk meningkatkan keterampilan Anda dan capai tujuan belajar Anda dengan lebih efektif.
                </p>
            </div>

        </div>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4 align-items-end mb-4">
            <div class="col-lg-12 wow fadeInUp my-auto" data-wow-delay="0.1s">
                <center>
                    <h1>Kursus Terpopuler</h1>
                </center>
                <br>
                @foreach ($kursus as $row)
                <div class="col-md-12 col-12 mb-4 text-center">
                    <a href="{{ url('kursusdetail/' . $row->idkursus) }}" class="btn btn-primary w-100 py-3">
                        {{ $row->namakursus }} ({{ $row->total_peserta }} peserta)
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection