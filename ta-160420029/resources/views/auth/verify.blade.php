@extends('layouts.main')

@section('title', 'Verifikasi Akun | FashionStore')

@section('content')
    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-light-600 text-white"
        data-image-src="{{ asset('assets/fe/img/photos/bg18.png') }}">
        <div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-1 mb-3">Buat Akun Baru</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
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
                            <h2 class="mb-3 text-start">Verifikasi Akun</h2>
                            <p class="lead mb-6 text-start">Periksa Email yang telah Anda isi untuk mengetahui Kode Verifikasi Email milik Anda.</p>
                            <form class="text-start mb-3" method="POST" action="{{ route('done') }}">
                                @csrf
                                <div class="form-floating mb-4">
                                    <input id="verification_code" type="text"
                                        class="form-control @error('verification_code') is-invalid @enderror"
                                        name="verification_code" value="{{ old('verification_code') }}" required
                                        placeholder="Kode Verifikasi">

                                    @error('verification_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <label for="verification_code">Kode Verifikasi Email</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary rounded-pill btn-login w-100 mb-2">
                                        {{ __('Daftar') }}
                                    </button>
                                </div>
                            </form>
                            <!-- /form -->
                            <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="hover">Login
                                    disini</a>
                            </p>
                            <!--/.social -->
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
@endsection
