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
    <!-- Apexcharts  CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/apexcharts/apexcharts.css"> --}}
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
                <div class="col-sm-12 col-lg-6 my-3">
                    <div class="card bg-white rounded p-4">
                        <div class="card-content">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group my-3">
                                    <label for="method">Metode Pembayaran</label>
                                    <select name="method" id="method" class="form-control" required>
                                        <option value="Manual" @if (old('method') == 'Manual') selected @endif>Manual
                                        </option>
                                        <option value="Otomatis" @if (old('method') == 'Otomatis') selected @endif>
                                            Otomatis</option>
                                    </select>
                                    <small class="text-warning" id="info_manual">Pembayaran metode manual silahkan baca
                                        informasi
                                        di bawah/di samping
                                        form ini</small>
                                </div>

                                <div class="form-group my-3">
                                    <label for="name">Nama</label>
                                    <select name="name" id="name" required
                                        class="form-control @if ($errors->has('name')) is-invalid @endif">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($user as $u)
                                            <option value="{{ $u->name }}" data-phone="{{ $u->phone_number }}"
                                                @if (old('name') == $u->name) selected @endif>{{ $u->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group my-3" id="email">
                                    <label for="email">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                        value="{{ old('email') }}" placeholder="cnth: emailanda@gmail.com">
                                </div>

                                <div class="form-group my-3">
                                    <label for="phone_number">Nomor WhatsApp</label>
                                    <input type="text" name="phone_number" id="phone_number"
                                        class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                        value="{{ old('phone_number') }}"
                                        placeholder="Otomatis terisi jika memilih nama" required readonly>
                                </div>

                                <div class="form-group my-3" id="via">
                                    <label for="via">Via</label>
                                    <select name="via" id="via_value" class="form-control">
                                        @forelse ($tripay_channel['data'] as $tc)
                                            <option value="{{ $tc['code'] }}"
                                                @if (old('via') == $tc['code']) selected @endif>{{ $tc['name'] }}
                                            </option>
                                        @empty
                                            <option value="" disabled>Tidak ada metode</option>
                                        @endforelse
                                    </select>
                                </div>

                                {{-- <div class="form-group my-3">
                                    <label for="month">Bulan Berapa</label>
                                    <input type="number" name="month" id="month" min="1" max="12"
                                        class="form-control @if ($errors->has('month')) is-invalid @endif"
                                        value="{{ old('month') }}" placeholder="cnth: 1 untuk Januari">
                                </div> --}}

                                <div class="form-group my-3">
                                    <label for="amount">Untuk Berapa Minggu</label>
                                    <input type="number" name="amount" id="amount" min="1" max="4"
                                        class="form-control @if ($errors->has('amount')) is-invalid @endif"
                                        value="{{ old('amount') }}" placeholder="cnth: 2">
                                    <span class="text-secondary">Banyak minggu</span>
                                </div>

                                <img src="https://via.placeholder.com/150x300.png?text=Bukti+Pembayaran"
                                    class="img-fluid" alt="" id="imgPreview">
                                <div class="form-group my-3" id="payment_proof">
                                    <label for="payment_proof">Bukti Pembayaran</label>
                                    <input type="file" name="payment_proof" id="payment_proof_input"
                                        class="form-control @if ($errors->has('payment_proof')) is-invalid @endif">
                                </div>

                                <div class="form-group my-3 text-black" id="total_fee_form">
                                    <span id="total_minggu">0</span> minggu x Rp. 10.000 = Rp. <span
                                        id="total_amount">0</span><br>
                                    Biaya Admin : Rp. <span id="total_fee">0</span> <br>
                                    Total yang harus dibayar : Rp. <span id="total_amount_fee">0</span>
                                </div>

                                <div class="form-group my-3">
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-8"></div>
                                        <div class="col-lg-2 col-sm-4">
                                            <button type="submit" class="btn btn-primary">Bayar</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 my-3">
                    <div class="row">
                        <div class="card bg-white rounded p-4 mb-3" id="rekening_manual">
                            <div class="card-content text-black">
                                <h3><b>Informasi Wallet</b></h3> <br>
                                <b>E-WALLET (DANA)</b> <br>
                                Nomor : <b>{{ $payment['dana_number'] }}</b> <br> A.N
                                <i>{{ $payment['dana_holder_name'] }}</i> <br>
                                <hr>
                                <b>QRIS :</b> <br>
                                <img src="{{ asset('storage') }}/{{ $payment['qris_url'] }}" class="img-fluid"
                                    alt="QRIS MARIKAS">
                                <br>
                            </div>
                        </div>
                        <div class="card bg-white rounded p-4">
                            <div class="card-content text-black">
                                Halo guys, <br>
                                disini kamu pilih ya mau bayar manual apa otomatis, <br>
                                dibawah ini penjelasan tentang manual dan otomatis. <br>
                                <br>
                                Manual berarti kamu bayar ke rekening/e-wallet yang telah ditentukan, <br>
                                namun pembayaran harus menunggu approval dari pemilik rekening/e-wallet. <br>
                                <br>
                                Otomatis berarti kamu membayar ke rekening/e-wallet yang telah ditentukan, <br>
                                namun pembayaran kamu akan diproses secara otomatis, tidak perlu menunggu <br>
                                approval pemilik rekening/e-wallet. kekurangannya adalah kamu akan terkena <br>
                                biaya admin dari layanan penyedia API dan biaya akan dibebankan ke kamu. <br>
                                <br>
                                Rekomendasi : menggunakan QRIS, paling murah dari yang lain.
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

    <!-- Chart Js -->
    {{-- <script src="{{ asset('storage') }}/assets/modules/apexcharts/apexcharts.js"></script>
    <script src="{{ asset('storage') }}/assets/js/ui-apexcharts.js"></script> --}}

    <!-- Template JS File -->
    <script src="{{ asset('storage') }}/assets/js/script.js"></script>
    <script src="{{ asset('storage') }}/assets/js/pay.js"></script>
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

        function calc_price(code, amount) {
            $.ajax({
                type: "POST",
                url: "{{ route('Tripay_Calc_Price') }}",
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    code: code,
                    amount: amount
                },
                success: function(response) {
                    $('#total_minggu').html($('#amount').val());
                    $('#total_amount').html($('#amount').val() * 10000);
                    $('#total_fee').html(response);
                    $('#total_amount_fee').html($('#amount').val() * 10000 + response);
                },
            });
        }

        $('#amount').on('change', function() {
            calc_price($('#via_value').val(), $('#amount').val());
        });

        $('#name').on('change', function() {
            $('#name option:nth-child(1)').attr('disabled', 'disabled');
            $('#phone_number').val($(this).find(':selected').data('phone'));
        });

        $('#via_value').on('change', function() {
            calc_price($('#via_value').val(), $('#amount').val());
        });
    </script>
</body>

</html>
