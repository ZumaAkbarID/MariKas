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
                    <h1 class="auth-title">Masuk</h1>
                    <p class="auth-subtitle mb-5">Masuk ke dalam aplikasi.</p>

                    <form action="" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl @error('auth') is-invalid @enderror"
                                placeholder="Username atau Nomor WhatsApp" name="auth" required
                                value="{{ old('auth') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="Password" id="password" name="password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Masuk</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Belum memiliki akun? <a href="{{ route('Auth_register') }}"
                                class="font-bold">Daftar</a>.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('auth_script')
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
@endsection
