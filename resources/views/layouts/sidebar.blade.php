@php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('assets/templates/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Aptavis</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/templates/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">User</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}"
                        class="nav-link {{ $segment1 == '' && $segment2 == '' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/clubs') }}" class="nav-link {{ $segment1 == 'clubs' ? 'active' : '' }}">
                        <i class="nav-icon far fa-futbol"></i>
                        <p>
                            Input Data Klub
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ $segment1 == 'scores' ? 'menu-open' : 'menu-close' }}">
                    <a href="#" class="nav-link {{ $segment1 == 'scores' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            Skor Pertandingan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/scores/single') }}"
                                class="nav-link {{ $segment2 == 'single' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Single</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/scores/multiple') }}"
                                class="nav-link {{ $segment2 == 'multiple' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Multiple</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/classments') }}"
                        class="nav-link {{ $segment1 == 'classments' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>
                            Klasemen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
