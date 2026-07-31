<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-stream"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a target="_blank" href="#" class="nav-link far fa-hand-point-right"> Go To Website</a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link far fa-hand-point-right">View Web</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" id="notificationBell">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="notifCount">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notifDropdown">
                <span class="dropdown-item dropdown-header" id="notifHeader">0 Notifications</span>
                <div id="notifList"></div>
                <div class="dropdown-divider"></div>
                <a href="/Admin/Dashboard/Tranksaksi" class="dropdown-item dropdown-footer">Lihat Semua</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" data-toggle="modal"
                data-target="#logout-header" href="#" role="button">
                <i class="fas fa-battery-quarter"></i>
            </a>
        </li>
    </ul>


</nav>
<form action="/Admin/Logout" method="POST">
    @csrf
    <div class="modal fade" id="logout-header" tabindex="-1" aria-labelledby="logout-headerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logout-headerLabel">Keluar Dari Backoffice Panel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="ml-2" style="font-size: 13px;">Apakah anda yakin ingin keluar?</h6>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger mr-2" style="font-size: 13px;">Keluar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="font-size: 13px;">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /.navbar -->
