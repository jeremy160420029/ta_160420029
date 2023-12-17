@extends('layouts.main')

@section('title', 'Login | QC System')

@section('content')

<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-light-600 text-white" data-image-src="{{ asset('assets/fe/img/photos/bg18.png') }}">
    <div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-1 mb-3">Login</h1>
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Halaman Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
                <!-- /nav -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-start">Selamat Datang</h2>
                        <p class="lead mb-6 text-start">Gunakan Username & Password untuk masuk ke dalam QC System</p>
                        <form class="text-start mb-3" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-4">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus id='loginUsername' placeholder="username">
                                <label for="loginUsername">Username</label>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-floating password-field mb-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label for="loginPassword">Password</label>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill btn-login w-100 mb-2">
                                {{ __('Login') }}
                            </button>
                        </form>
                        <!-- /form -->
                        <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}" class="hover">Buat disini
                            </a></p>
                    </div>
                    <!--/.card-body -->
                </div>
                <!--/.card -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

@endsection
