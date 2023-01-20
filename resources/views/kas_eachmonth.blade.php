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
                <div class="col-lg-12 card bg-white text-black shadow-sm rounded p-3">
                    <div class="card-body">
                        <div class="col-sm-12 col-lg-8">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-2">
                                        <div class="form-group">
                                            <label for="bulan">Filter Bulan</label>
                                            <select name="bulan" id="" class="form-control">
                                                @for ($i = 0; $i < 12; $i++)
                                                    <option value="{{ $month[$i] }}"
                                                        @if (!Request::get('bulan') && (int) date('m') - 1 == $i) selected @elseif(Request::get('bulan') == $month[$i]) selected @endif>
                                                        {{ $month[$i] }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-2">
                                        <div class="form-group">
                                            <label for="tahun">Filter Tahun</label>
                                            <input type="text" name="tahun" id="tahun" class="form-control"
                                                value="{{ Request::get('tahun') }}" maxlength="4" minlength="3">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="nama">Filter Nama</label>
                                            <input type="text" name="nama" id="" class="form-control"
                                                value="{{ Request::get('nama') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-2 mt-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            @php
                                $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            <h4>Data bulan
                                {{ Request::get('bulan') == '' ? $month[(int) date('m') - 1] : Request::get('bulan') }}
                                tahun
                                {{ Request::get('tahun') == '' ? date('Y') : Request::get('tahun') }}
                            </h4>
                            <h5>
                                {{ Request::get('nama') ? 'Menampilkan data untuk nama : ' . Request::get('nama') : '' }}
                            </h5>
                            <div class="row">
                                <div class="mt-2">
                                    <h6>Minggu 1</h6>
                                    <ul class="list-group">
                                        @php
                                            $week1 = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($data); $i++)
                                            @if ($data[$i]['week'] == 1)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span> {{ $data[$i]['name'] }}</span>
                                                    <span
                                                        class="badge bg-success badge-pill badge-round ml-1">Lunas</span>
                                                </li>
                                                @php $week1++; @endphp
                                            @endif
                                        @endfor
                                        @if ($week1 == 0)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> Tidak ada data</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="mt-2">
                                    <h6>Minggu 2</h6>
                                    <ul class="list-group">
                                        @php
                                            $week2 = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($data); $i++)
                                            @if ($data[$i]['week'] == 2)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span> {{ $data[$i]['name'] }}</span>
                                                    <span
                                                        class="badge bg-success badge-pill badge-round ml-1">Lunas</span>
                                                </li>
                                                @php $week2++; @endphp
                                            @endif
                                        @endfor
                                        @if ($week2 == 0)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> Tidak ada data</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="mt-2">
                                    <h6>Minggu 3</h6>
                                    <ul class="list-group">
                                        @php
                                            $week3 = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($data); $i++)
                                            @if ($data[$i]['week'] == 3)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span> {{ $data[$i]['name'] }}</span>
                                                    <span
                                                        class="badge bg-success badge-pill badge-round ml-1">Lunas</span>
                                                </li>
                                                @php $week3++; @endphp
                                            @endif
                                        @endfor
                                        @if ($week3 == 0)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> Tidak ada data</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="mt-2">
                                    <h6>Minggu 4</h6>
                                    <ul class="list-group">
                                        @php
                                            $week4 = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($data); $i++)
                                            @if ($data[$i]['week'] == 4)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span> {{ $data[$i]['name'] }}</span>
                                                    <span
                                                        class="badge bg-success badge-pill badge-round ml-1">Lunas</span>
                                                </li>
                                                @php $week4++; @endphp
                                            @endif
                                        @endfor
                                        @if ($week4 == 0)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> Tidak ada data</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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
</body>

</html>
