<div class="topbar transition">
    <div class="bars">
        <button type="button" class="btn transition" id="sidebar-toggle">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="menu">
        <ul>
            <li class="nav-item dropdown dropdown-list-toggle">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif">!</span>
                </a>
                <div class="dropdown-menu dropdown-list">
                    <div class="dropdown-header text-white">Notifikasi</div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <div class="custome-list border-top border-1">
                            @forelse ($notification as $notif)
                                <a href="{{ route('Notif_Read', $notif->id) }}" class="dropdown-item">
                                    <div
                                        class="dropdown-item-icon 
                                    @if ($notif->type == 'success') bg-success
@elseif($notif->type == 'error')
bg-danger
@elseif($notif->type == 'warning')
bg-warning
@elseif($notif->type == 'info')
bg-info @endif
text-white">
                                        @if ($notif->type == 'success')
                                            <i class="fas fa-check"></i>
                                        @elseif($notif->type == 'error')
                                            <i class="fas fa-times"></i>
                                        @elseif($notif->type == 'warning')
                                            <i class="fas fa-info"></i>
                                        @elseif($notif->type == 'info')
                                            <i class="fas fa-bell"></i>
                                        @endif
                                    </div>
                                    <div class="dropdown-item-desc">
                                        {{ Str::limit($notif->message, 50) }}
                                        <div class="time text-primary">
                                            {{ date('D H:i:s d-m-Y', strtotime($notif->updated_at)) }}</div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-white text-center">Tidak ada notif</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="dropdown-footer text-center">
                        <a href="{{ route('Notif_All') }}">Lihat Semua</a>
                    </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ asset('storage') }}/assets/images/avatar/avatar-1.png" alt="">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"><i class="fa fa-user size-icon-1"></i>
                        <span>Profil (coming soon)</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-cog size-icon-1"></i>
                        <span>Pengaturan (coming soon)</span></a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item text-danger" href="{{ route('Auth_logout') }}"><i
                            class="fa fa-sign-out-alt  size-icon-1"></i> <span>Keluar</span></a>
                </ul>
            </li>
        </ul>
    </div>
</div>
