<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MyCourse</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('foto/logo.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/home/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/home/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/home/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel=" stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid px-0 wow fadeIn" data-wow-delay="0.1s">
        <nav class="navbar navbar-expand-lg navbar-light py-lg-3 px-lg-5 py-5 wow fadeIn bg-white" data-wow-delay="0.1s"
            style="background-color: #275a82 !important">
            <a href="/" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="display-5 text-white m-0">MyCourse</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0"
                    style="background-color: #275a82 !important; margin-right: 60px !important">
                    <a href="{{ url('/') }}" class="nav-item nav-link text-white">Home</a>
                    <a href="{{ url('kursusdaftar') }}" class="nav-item nav-link text-white">Kursus</a>

                    @if (session('akuninternal'))
                        {{-- dropdown menu akun --}}
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-white"
                                data-bs-toggle="dropdown">Akun</a>
                            <div class="dropdown-menu dropdown-menu-start m-0">
                                @if (session('akuninternal')->level == 'Admin' || session('akuninternal')->level == 'Guru')
                                    <a href="{{ url('panel') }}" class="dropdown-item">Panel</a>
                                @else
                                    <a href="{{ url('profile') }}" class="dropdown-item">Profile</a>
                                    <a href="{{ url('riwayatpendaftaran') }}" class="dropdown-item">Riwayat
                                        Pendaftaran</a>
                                @endif
                                <a href="{{ url('logout') }}" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    @else
                        <a href="{{ url('loginakun') }}" class="nav-item nav-link text-white">Login</a>
                    @endif
                </div>
            </div>
        </nav>
    </div>


    {{-- content --}}
    @yield('content');


    <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s"
        style="background-color: #275a82 !important">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-12 col-md-12">
                    <h4 class="text-white mb-4">MyCourse</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Makassar</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>085555555</p>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="/home/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
            $('#tabel').DataTable();
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        $(function() {
            @if ($message = session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= session('success') ?>'
                })
            @endif
        });
        $(function() {
            @if ($message = session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session('error') ?>'
                })
            @endif
        });
        const flashData = $('.flash-data').data('flashdata');
        // console.log(flashData);
        if (flashData) {
            Swal.fire({
                title: 'Berhasil !',
                text: '' + flashData,
                icon: 'success',
                showConfirmButton: false,
                timer: 3500
            });
        }
        const flashDataError = $('.flash-data-error').data('flashdata');
        // console.log(flashData);
        if (flashDataError) {
            Swal.fire({
                title: 'Gagal !',
                text: '' + flashDataError,
                icon: 'error',
                showConfirmButton: false,
                timer: 3500
            });
        }
        $('.bdel').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success m-1',
                    cancelButton: 'btn btn-danger m-1'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Yakin data ini akan dihapus?',
                text: "Data tidak akan bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        '',
                        'error'
                    )
                }
            });
        });
        $('.blogout').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success m-1',
                    cancelButton: 'btn btn-danger m-1'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah Anda yakin ingin logout',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        '',
                        'error'
                    )
                }
            });
        });
    </script>

    @yield('script')
</body>

</html>
