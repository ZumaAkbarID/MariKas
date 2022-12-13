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
                    <h1 class="auth-title">Daftar</h1>
                    <p class="auth-subtitle mb-5">Buat akun pribadi Anda disini.</p>

                    <form action="" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror"
                                placeholder="Nama Lengkap" name="name" required value="{{ old('name') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person-lines-fill"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('username') is-invalid @enderror"
                                placeholder="Username" name="username" required value="{{ old('username') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        {{-- <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                                placeholder="Email" name="email" required value="{{ old('email') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div> --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('phone_number') is-invalid @enderror"
                                placeholder="Nomor WhatsApp" name="phone_number" id="phone_number" required
                                value="{{ old('phone_number') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('address') is-invalid @enderror"
                                placeholder="Alamat" name="address" required value="{{ old('address') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-geo-alt"></i>
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
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="Konfirmasi Password" id="password_confirmation" name="password_confirmation"
                                required>
                            <div class="form-control-icon">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Buat Akun</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Sudah memiliki akun? <a href="auth-login.html" class="font-bold">Masuk</a>.
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
