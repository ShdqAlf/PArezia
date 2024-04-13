{{-- Mun rek misah ken menu sesuai role pake if --}}

{{--
    Contoh na :
    If (Auth::user()->role == 'Admin'){
        <li class="sidebar-item active ">
            <a href="index.html" class='sidebar-link'>
                <i data-feather="home" width="20"></i>
                <span>Dashboard</span>
            </a>
        </li>
    }
Jadi nu muncul ngan menu eta di role eta.
    --}}


<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                @if (Auth::user()->role == 'Staff')
                    <li
                        class="sidebar-item {{ 'staff' == request()->path() ? 'active' : '' }} {{ Str::startsWith(request()->path(), 'pelamar/teskemampuan/') ? 'active' : '' }}">
                        <a href="{{ route('staff.dashboard') }}" class='sidebar-link'>
                            <i data-feather="home" width="20"></i>
                            <span>Kelola Penilaian</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-item {{ Str::startsWith(request()->path(), 'staff/perhitungan/') ? 'active' : '' }}">
                        <a href="{{ route('staff.kelola.perhitungan') }}" class='sidebar-link'>
                            <i data-feather="home" width="20"></i>
                            <span>Kelola Perhitungan</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'Pelamar')
                    <li class='sidebar-title'>Main Menu</li>
                    <li
                        class="sidebar-item {{ 'pelamar' == request()->path() ? 'active' : '' }}  {{ Str::startsWith(request()->path(), 'pelamar/teskemampuan/') ? 'active' : '' }}">
                        <a href="{{ route('pelamar.dashboard') }}" class='sidebar-link'>
                            <i data-feather="home" width="20"></i>
                            <span>Lowongan Pekerjaan</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-item {{ Str::startsWith(request()->path(), 'pelamar/laporanhasil') ? 'active' : '' }}">
                        <a href="{{ route('pelamar.laporan.hasil') }}" class='sidebar-link'>
                            <i data-feather="home" width="20"></i>
                            <span>Laporan Hasil</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'Admin')
                    <li class='sidebar-title'>Main Menu</li>
                    <li class="sidebar-item ">
                        <a href="index.html" class='sidebar-link'>
                            <i data-feather="home" width="20"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class='sidebar-title'>Kelola</li>
                    <li class="sidebar-item  ">
                        <a href="{{ route('admin.kelolauser.index') }}" class='sidebar-link'>
                            <i data-feather="layout" width="20"></i>
                            <span>Kelola User</span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="{{ route('admin.kelolates.index') }}" class='sidebar-link'>
                            <i data-feather="layers" width="20"></i>
                            <span>Kelola Tes Kemampuan</span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="{{ route('admin.kelolaloker.index') }}" class='sidebar-link'>
                            <i data-feather="grid" width="20"></i>
                            <span>Kelola Lowongan Pekerjaan</span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="{{ route('admin.kelolakriteria.index') }}" class='sidebar-link'>
                            <i data-feather="file-plus" width="20"></i>
                            <span>Kelola Bobot Penilaian</span>
                        </a>
                    </li>
                    <li class="sidebar-item  ">
                        <a href="table-datatable.html" class='sidebar-link'>
                            <i data-feather="file-plus" width="20"></i>
                            <span>Kelola Penilaian Pelamar</span>
                        </a>
                    </li>

                    <li class='sidebar-title'>Reports</li>
                    <li class="sidebar-item  ">
                        <a href="table-datatable.html" class='sidebar-link'>
                            <i data-feather="file-plus" width="20"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
