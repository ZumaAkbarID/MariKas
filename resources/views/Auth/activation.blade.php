@extends('Layouts.auth')

@section('auth')
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-left">

                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div id="auth-right">
                    <div class="auth-logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('storage') }}/assets/images/logo.png"
                                alt="Logo">{{ $config['app_name'] }}</a>
                    </div>
                    <h1 class="auth-title">Verifikasi Nomor WhatsApp</h1>
                    <p class="auth-subtitle mb-5">Masukkan kode yang telah dikirimkan ke WhatsApp Anda.</p>

                    <form action="" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="6 Digit Kode">
                            <div class="form-control-icon">
                                <i class="bi bi-key"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Aktifasi</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Salah nomor? Hubungi Developer.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
