<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website." />
    <meta name="keywords"
        content="bootstrap 5, business, corporate, creative, gulp, marketing, minimal, modern, multipurpose, one page, responsive, saas, sass, seo, startup, html5 template, site template" />
    <meta name="author" content="elemis" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/fe/img/favicon.png') }} />
        <link rel=" stylesheet"
        href="{{ asset('assets/fe/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/colors/purple.css') }}" />
    <link rel="preload" href="{{ asset('assets/fe/css/fonts/thicccboi.css') }}" as="style"
        onload="this.rel='stylesheet'" />
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="content-wrapper">
        @if (session('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!--Navbar-->
        <header class="wrapper bg-soft-primary">
            <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
                <div class="container flex-lg-row flex-nowrap align-items-center">
                    <div class="navbar-brand w-50">
                        <a href="{{ url('/') }}">
                            <h1>QC System</h1>
                            {{-- <img src="{{ asset('assets/fe/img/FS-sm.png') }}"
                            srcset="{{ asset('assets/fe/img/FS-lg.png') }} 2x" alt="" /> --}}
                        </a>
                    </div>
                    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                        <div class="offcanvas-header d-lg-none">
                            <h3 class="text-white fs-30 mb-0">QC System</h3>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('processes') }}">Pengecekan Sepatu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('brands') }}">Brand Sepatu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('articles') }}">Artikel Sepatu</a>
                                </li>
                                @can('is-user')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('histories') }}">Riwayat Pengecekan</a>
                                    </li>
                                @endcan
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="offcanvas-footer d-lg-none">
                                <div>
                                    <a href="mailto:#" class="link-inverse">s160420029@student.ubaya.ac.id</a>
                                    <br />
                                    160420029 - Jeremy <br />
                                    <nav class="nav social social-white mt-4">
                                        <a href="#"><i class="uil uil-twitter"></i></a>
                                        <a href="#"><i class="uil uil-facebook-f"></i></a>
                                        <a href="#"><i class="uil uil-dribbble"></i></a>
                                        <a href="#"><i class="uil uil-instagram"></i></a>
                                        <a href="#"><i class="uil uil-youtube"></i></a>
                                    </nav>
                                    <!-- /.social -->
                                </div>
                            </div>
                            <!-- /.offcanvas-footer -->
                        </div>
                        <!-- /.offcanvas-body -->
                    </div>
                    <!-- /.navbar-collapse -->
                    <div class="navbar-other w-100 d-flex ms-auto">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            @if (!Auth::user())
                                <li class="nav-item d-none d-md-block">
                                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill">Login</a>
                                </li>
                                <li class="nav-item d-lg-none">
                                    <button class="hamburger offcanvas-nav-btn"><span></span></button>
                                </li>
                            @else
                                <li class="nav-item">
                                </li>
                                <li class="nav-item d-lg-none">
                                    <button class="hamburger offcanvas-nav-btn"><span></span></button>
                                </li>
                                <li class="nav-item dropdown d-none d-md-block">
                                    <h6 class="dropdown-item btn btn-primary rounded-pill dropdown-item">Halo,
                                        {{ Auth::user()->username }}</h6>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="dropdown-item" href="{{ route('profile') }}"><i
                                                    class="uil uil-setting"></i> Profil Saya </a></li>
                                        <li class="nav-item"><a class="dropdown-item"
                                                href="{{ route('change_password') }}"><i class="uil uil-setting"></i>
                                                Ganti Password</a></li>
                                        @can('is-admin')
                                            <li class="nav-item"><a class="dropdown-item" href="{{ url('/admin/brand') }}"><i
                                                        class="uil uil-user-md"></i> Admin</a></li>
                                        @endcan
                                        <li class="nav-item"><a href="{{ route('logout') }}" class="dropdown-item"
                                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i
                                                    class="uil uil-signout"></i> Log Out</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none" hidden>
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!--/.dropdown-menu -->
                                </li>
                                <li class="nav-item d-lg-none">
                                    <button class="hamburger offcanvas-nav-btn"><span></span></button>
                                </li>
                            @endif
                        </ul>
                        <!-- /.navbar-nav -->
                    </div>
                    <!-- /.navbar-other -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->


        </header>
        <!--Main Content taruh sini-->
        @yield('content')
    </div>

    <!--Footer-->
    <footer class="bg-dark text-inverse">
        <div class="container py-13 py-md-15">
            <div class="row gy-6 gy-lg-0">
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        {{-- <img class="mb-4" src="{{ asset('assets/fe/img/logo-light.png') }}"
                        srcset="{{ asset('assets/fe/img/logo-light.png') }} 2x" alt="" /> --}}
                        <h4 class="widget-title text-white mb-3">QC System</h4>
                        <p class="mb-4">© 2023 Jeremy Richard Benedict. <br class="d-none d-lg-block" />All rights
                            reserved.</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">Lebih dekat dengan Sistem</h4>
                        <a href="mailto:#">s160420029@student.ubaya.ac.id</a><br /> 160420029 - Jeremy
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="{{ asset('assets/fe/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/fe/js/theme.js') }}"></script>
    @yield('js')
</body>
