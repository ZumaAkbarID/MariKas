<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ $title }}</title>

    <link rel="shortcut icon" href="{{ asset('storage/assets') }}/{{ $config['app_favicon'] }}" type="image/x-icon">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/bootstrap-5.1.3/css/bootstrap.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/css/style.css">
    <!-- Boostrap Icon-->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/bootstrap-icons/bootstrap-icons.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/sweetalert/sweetalert.min.css">
</head>

<body>

    @yield('auth')

    <!-- General JS Scripts -->
    <script src="{{ asset('storage') }}/assets/js/atrana.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('storage') }}/assets/modules/jquery/jquery.min.js"></script>
    <script src="{{ asset('storage') }}/assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('storage') }}/assets/modules/popper/popper.min.js"></script>

    <!-- SweetAlert Js -->
    <script src="{{ asset('storage') }}/assets/modules/sweetalert/sweetalert.all.min.js"></script>
    <script src="{{ asset('storage') }}/assets/js/sweetalerts.js"></script>

    <!-- Template JS File -->
    {{-- <script src="{{ asset('storage') }}/assets/js/script.js"></script> --}}
    <script src="{{ asset('storage') }}/assets/js/auth.js"></script>
    <script src="{{ asset('storage') }}/assets/js/custom.js"></script>

    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: "{!! implode('', $errors->all('<div>:message</div>')) !!}"
            });
        @endif
        @if (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: "{!! session('error') !!}"
            });
        @endif
    </script>
    @yield('auth_script')

</body>

</html>
