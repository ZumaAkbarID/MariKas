<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
    <div class="sidebar-content">
        <div id="sidebar">

            <!-- Logo -->
            <div class="logo">
                <h2 class="mb-0"><img src="{{ asset('storage/assets') }}/{{ $config['app_favicon'] }}">
                    {{ $config['app_name'] }}
                </h2>
            </div>

            <ul class="side-menu">
                <li>
                    <a href="{{ route('Dashboard') }}" class="@if (Request::segment(1) == 'dashboard') active @endif">
                        <i class='bx bxs-dashboard icon'></i> Dashboard
                    </a>
                    <a href="{{ route('Kas_Index') }}" class="@if (Request::segment(1) == 'kas') active @endif">
                        <i class='bx bxs-dashboard icon'></i> Lihat Kas
                    </a>
                </li>

                @if ($user->u_roles[0]->role == 'Developer')
                    <!-- Divider-->
                    <li class="divider" data-text="Developer">Developer</li>

                    <li>
                        <a href="#">
                            <i class='bx bx-columns icon'></i>
                            Settings
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="#">Web Config (coming soon)</a></li>
                            <li><a href="{{ route('API_FastWa_Connect') }}">Connect WhatsApp Api</a></li>
                        </ul>
                    </li>
                @endif

                @if ($user->u_roles[0]->role == 'Pemilik' || $user->u_roles[0]->role == 'Developer')
                    <!-- Divider-->
                    <li class="divider" data-text="Pengurus">Pengurus</li>

                    <li>
                        <a href="#">
                            <i class='bx bx-columns icon'></i>
                            MariMas
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="{{ route('Pemilik_Manual') }}">Pembayaran Manual</a></li>
                            <li><a href="{{ route('Pemilik_Approval') }}">Aproval Pembayaran</a></li>
                            <li><a href="{{ route('Pemilik_Tripay') }}">Data Tripay</a></li>
                            <li><a href="{{ route('Pemilik_Cashout') }}">Pengeluaran</a></li>
                        </ul>
                    </li>
                @endif

                {{-- @if ($user->u_roles[0]->role == 'Anggota' || $user->u_roles[0]->role == 'Developer')
                    <!-- Divider-->
                    <li class="divider" data-text="Anggota">Anggota</li>

                    <li>
                        <a href="{{ url('/') }}" class="active">
                            <i class='bx bxs-dashboard icon'></i> Bayar Kas
                        </a>
                    </li>
                @endif --}}

            </ul>

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
