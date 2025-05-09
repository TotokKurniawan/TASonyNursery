<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sony Nursery || User</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assetsuser/vendor/aos/aos.css') }} " rel="stylesheet">
    <link href="{{ asset('assetsuser/vendor/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('assetsuser/vendor/bootstrap-icons/bootstrap-icons.css') }} " rel="stylesheet">
    <link href="{{ asset('assetsuser/vendor/boxicons/css/boxicons.min.css') }} " rel="stylesheet">
    <link href="{{ asset('assetsuser/vendor/swiper/swiper-bundle.min.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assetsuser/css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        @include('layoutuser.header')
    </header><!-- End Header -->


    @yield('content')


    <!-- ======= Footer ======= -->
    <footer class="footer" role="contentinfo">
        @include('layoutuser.footer')
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assetsuser/vendor/aos/aos.js') }} "></script>
    <script src="{{ asset('assetsuser/vendor/bootstrap/js/popper.js') }} "></script>
    <script src="{{ asset('assetsuser/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('assetsuser/vendor/swiper/swiper-bundle.min.js') }} "></script>
    <script src="{{ asset('assetsuser/vendor/php-email-form/validate.js') }} "></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assetsuser/js/main.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                text: 'Anda telah berhasil masuk.',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>



</body>

</html>
