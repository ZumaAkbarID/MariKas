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
                    <i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif">4</span>
                </a>
                <div class="dropdown-menu dropdown-list">
                    <div class="dropdown-header">Notifikasi</div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <div class="custome-list-notif">
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    xxxx
                                    <div class="time text-primary">3 xx</div>
                                </div>
                            </a>

                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    xxx
                                    <div class="time">12 xxx</div>
                                </div>
                            </a>

                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-danger text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    xxxx
                                    <div class="time">20 xxxx</div>
                                </div>
                            </a>


                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    xxxx
                                    <div class="time">xxxx</div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="dropdown-footer text-center">
                        <a href="#">Lihat Semua</a>
                    </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ asset('storage') }}/assets/images/avatar/avatar-1.png" alt="">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="my-profile.html"><i class="fa fa-user size-icon-1"></i>
                        <span>Profil</span></a>
                    <a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i>
                        <span>Pengaturan</span></a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item text-danger" href="{{ route('Auth_logout') }}"><i
                            class="fa fa-sign-out-alt  size-icon-1"></i> <span>Keluar</span></a>
                </ul>
            </li>
        </ul>
    </div>
</div>
