<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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
    <!-- Calendar  CSS -->
    {{-- <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' /> --}}
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/sweetalert/sweetalert.min.css">
</head>

<body>

    <div class="topbar transition bg-primary">
        <div class="bars">
            <button type="button" class="btn transition" id="sidebar-toggle">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>

    <!--Sidebar-->
    <div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
        <div class="sidebar-content">
            <div id="sidebar">

                <!-- Logo -->
                <div class="logo">
                    <h2 class="mb-0"><img src="{{ asset('storage/assets') }}/{{ $config['app_favicon'] }}">
                        {{ $config['app_name'] }}
                    </h2>
                </div>

                @include('Layouts.front_menu')

                <div class="ads">
                    <div class="wrapper">
                        <div class="help-icon"><i class="fa fa-circle-exclamation fa-3x"></i></div>
                        <p>Jangan lupa <strong class="text-danger">BAYAR KAS !</strong></p>
                        <a href="javascript:void(0)" class="btn-upgrade">wkwkwk</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- End Sidebar-->


    <div class="sidebar-overlay"></div>


    <div class="content-start transition">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 card bg-white shadow-sm rounded p-3">
                    <div id="calendar" style="min-height: 1200px !important;" class="text-black"></div>
                </div>
            </div>
        </div>
    </div>


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

    <!-- Calendar -->
    <script src='{{ asset('storage') }}/assets/modules/fullcalendar-6.0.2/dist/index.global.min.js'></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}

    <!-- Template JS File -->
    <script src="{{ asset('storage') }}/assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            if (sessionStorage.getItem("kalendar-warning") !== 'true') {
                sessionStorage.setItem("kalendar-warning", "true");
                Swal.fire({
                    title: 'Perhatian!',
                    text: "Display Kas berdasarkan Kalendar masih mengalami BUG visual!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Mengerti',
                });
            }
        });

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

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    start: 'dayGridMonth',
                    center: 'title',
                    end: 'prevYear,prev,next,nextYear'
                },
                firstDay: 1,
                locale: 'id',
                events: [
                    <?php foreach($data as $kas) : ?> {
                        title: "<?= $kas['name'] ?>",
                        start: "<?= $kas['start'] ?>",
                        end: "<?= $kas['end'] ?>",
                        color: '#3B82F6'
                    },
                    <?php endforeach; ?>
                ],
                selectOverlap: function(event) {
                    return event.rendering === 'background';
                }
            });

            calendar.render();
        });
    </script>
</body>

</html>
