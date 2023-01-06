<ul class="side-menu">
    @if (Auth::check())
        <li>
            <a href="{{ route('Dashboard') }}">
                <i class='bx bxs-dashboard icon'></i> Dashboard
            </a>
        </li>
    @else
        <li>
            <a href="{{ route('Auth_login') }}">
                <i class='bx bxs-user icon'></i> Masuk
            </a>
        </li>
    @endif
    <li>
        <a href="{{ route('Kas_Index') }}" class="@if (Request::segment(1) == 'kas') active @endif">
            <i class='bx bxs-dashboard icon'></i> Kas
        </a>
    </li>
    <li>
        <a href="{{ url('/') }}" class="@if (Request::segment(1) == '') active @endif">
            <i class='bx bxs-dashboard icon'></i> Bayar Kas
        </a>
    </li>
</ul>
