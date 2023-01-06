<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <link rel="shortcut icon" href="{{ asset('storage/assets') }}/{{ $config['app_favicon'] }}" type="image/x-icon">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/bootstrap-5.1.3/css/bootstrap.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/css/style.css">
    <!-- FontAwesome CSS-->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/fontawesome6.1.1/css/all.css">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/boxicons/css/boxicons.min.css">
    <!-- Apexcharts  CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/apexcharts/apexcharts.css"> --}}
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/sweetalert/sweetalert.min.css">
</head>

<body>

    <!--Topbar -->
    @include('Layouts.app_topbar')

    <!--Sidebar-->
    @include('Layouts.app_sidebar')
    <!-- End Sidebar-->


    <div class="sidebar-overlay"></div>


    <!--Content Start-->
    @yield('app_content')


    <!-- Footer -->
    @include('Layouts.app_footer')


    <!-- Preloader -->
    <div class="loader">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only">Tunggu sebentar...</span>
        </div>
    </div>

    <!-- Loader -->
    <div class="loader-overlay"></div>

    <!-- General JS Scripts -->
    <script src="{{ asset('storage') }}/assets/js/marikas.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('storage') }}/assets/modules/jquery/jquery.min.js"></script>
    <script src="{{ asset('storage') }}/assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('storage') }}/assets/modules/popper/popper.min.js"></script>

    <!-- SweetAlert Js -->
    <script src="{{ asset('storage') }}/assets/modules/sweetalert/sweetalert.all.min.js"></script>

    <!-- Chart Js -->
    {{-- <script src="{{ asset('storage') }}/assets/modules/apexcharts/apexcharts.js"></script>
    <script src="{{ asset('storage') }}/assets/js/ui-apexcharts.js"></script> --}}

    <!-- Template JS File -->
    <script src="{{ asset('storage') }}/assets/js/script.js"></script>
    <script src="{{ asset('storage') }}/assets/js/custom.js"></script>
    <script>
        @if (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: "{!! session('error') !!}"
            });
        @endif
        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Yay...',
                html: "{!! session('success') !!}"
            });
        @endif
    </script>
    @yield('app_js')
</body>

</html>
