<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
            @if (Auth::user()->role == 'Pelamar')
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="avatar mr-1">
                            @if (Auth::user()->pelamar->foto_profil == null)

                            <img src="https://cdn.idntimes.com/content-images/post/20240207/33bac083ba44f180c1435fc41975bf36-ca73ec342155d955387493c4eb78c8bb.jpg" alt="" srcset="">
                            @else

                            <img src="{{ asset(Auth::user()->pelamar->foto_profil) }}" alt="" srcset="">
                            @endif
                        </div>
                        <div class="d-none d-md-block d-lg-inline-block">{{ Auth::user()->pelamar->nama }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('pelamar.profil') }}"><i data-feather="user"></i> Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="log-out"></i> Logout</a>
                    </div>
                </li>
            @elseif(Auth::user()->role == 'Admin')
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="avatar mr-1">
                            <img src="{{ asset('assets/images/avatar/avatar-s-1.png') }}" alt="" srcset="">
                        </div>
                        <div class="d-none d-md-block d-lg-inline-block">{{ Auth::user()->role }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="log-out"></i> Logout</a>
                    </div>
                </li>
            @elseif(Auth::user()->role == 'Staff')
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="avatar mr-1">
                            <img src="{{ asset('assets/images/avatar/avatar-s-1.png') }}" alt="" srcset="">
                        </div>
                        <div class="d-none d-md-block d-lg-inline-block">{{ Auth::user()->role }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="log-out"></i> Logout</a>
                    </div>
                </li>
            @elseif(Auth::user()->role == 'Pimpinan')
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="avatar mr-1">
                            <img src="{{ asset('assets/images/avatar/avatar-s-1.png') }}" alt="" srcset="">
                        </div>
                        <div class="d-none d-md-block d-lg-inline-block">{{ Auth::user()->role }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="log-out"></i> Logout</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
