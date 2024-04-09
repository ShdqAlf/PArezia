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
            <img src="assets/images/logo.svg" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
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
                    <a href="form-editor.html" class='sidebar-link'>
                        <i data-feather="layers" width="20"></i>
                        <span>Kelola Tes Kemampuan</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="table.html" class='sidebar-link'>
                        <i data-feather="grid" width="20"></i>
                        <span>Kelola Lowongan Pekerjaan</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="table-datatable.html" class='sidebar-link'>
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

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>