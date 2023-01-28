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
                    <h1 class="auth-title">Reset Password</h1>
                    <p class="auth-subtitle mb-5">Kode akan dikirimkan ke Nomor WhatsApp Anda.</p>

                    <div class="form-group position-relative has-icon-left mb-4" id="elementAuth">
                        <input type="text" class="form-control form-control-xl @error('auth') is-invalid @enderror"
                            placeholder="Username atau Nomor WhatsApp" name="auth" required value="{{ old('auth') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div id="requestedOtp">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl @error('otp') is-invalid @enderror"
                                placeholder="6 Digit Kode" name="otp" id="otp" maxlength="6" minlength="6"
                                required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="Password Baru" id="password" name="password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" id="submit">Kirim OTP</button>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600' id="resend_otp">OTP tidak berfungsi? <a href="#"
                                id="resend_otp_btn">Kirim Ulang Kode</a>.
                        </p>
                        <p class='text-gray-600'>Ingat password? <a href="{{ route('Auth_login') }}">Login</a>.
                        </p>
                        <p class='text-gray-600'>WhatsApp belum aktif? Hubungi Developer.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('auth_script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            let requestedOtp = $('#requestedOtp');
            let resend_otp = $('#resend_otp');
            requestedOtp.hide();
            resend_otp.hide();

            $('#submit').on('click', function() {

                let elementAuth = $('#elementAuth');
                let submitBtn = $('#submit');

                if (submitBtn.html() == 'Kirim OTP') {
                    let auth = $('input[name="auth"]').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('Auth_forgot_otp') }}",
                        data: {
                            auth: auth
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    title: 'Yay...',
                                    text: data.msg,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Okey',
                                }).then((res) => {
                                    $('input[name="auth"]').attr('readonly',
                                        'readonly');
                                    submitBtn.html('Perbarui Password');
                                    requestedOtp.show();
                                    resend_otp.show();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Oops...',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Okey',
                                });
                            }
                        }
                    });
                } else {
                    let auth = $('input[name="auth"]').val();
                    let otp = $('input[name="otp"]').val();
                    let password = $('input[name="password"]').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('Auth_forgot_process') }}",
                        data: {
                            auth: auth,
                            otp: otp,
                            password: password
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    title: 'Yay...',
                                    text: data.msg,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Okey',
                                }).then((result) => {
                                    window.location.href = '{{ route('Auth_login') }}';
                                });
                            } else {
                                Swal.fire({
                                    title: 'Oops...',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Okey',
                                });
                            }
                        }
                    });
                }

            });

            $('#resend_otp_btn').click(function() {
                let auth = $('input[name="auth"]').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('Auth_forgot_otp') }}",
                    data: {
                        auth: auth
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                title: 'Yay...',
                                text: data.msg,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Okey',
                            });
                        } else {
                            Swal.fire({
                                title: 'Oops...',
                                text: data.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Okey',
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
