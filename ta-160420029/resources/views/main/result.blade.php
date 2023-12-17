@extends('layouts.main')

@section('title')
    Halaman Hasil Pengecekan Sepatu | QC System
@endsection

@section('content')
    <section class="wrapper bg-gray">
        @if (session('success'))
            <div class="alert alert-success text-center"
                style="background-color: #dff0d8; border-color: #d6e9c6; color: #3c763d; padding: 15px;">
                {{ session('success') }}
            </div>
        @endif
        <section class="wrapper bg-gray">
            <div class="container py-3 py-md-5">
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ url('processes') }}">Halaman Pengecekan
                                Sepatu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Hasil</li>
                    </ol>
                </nav>
                <!-- /nav -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->
        <section class="wrapper bg-light">
            <div class="container py-14 py-md-16">
                <div class="row gx-md-8 gx-xl-12 gy-8">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <section class="wrapper image-wrapper bg-image bg-cover text-white"
                                    data-image-src="data:image/jpeg;base64,{{ base64_encode($histories->image_data) }}">
                                    {{-- <section class="wrapper image-wrapper bg-image bg-cover text-white" data-image-src=""> --}}
                                    <div class="container py-14 py-md-21">
                                    </div>
                                    <!-- /.container -->
                                </section>
                                <!-- /section -->
                            </div>
                            <br>
                            @can('is-user')
                                <a href="{{ route('check', $articles->id) }}" class="btn btn-primary">Lakukan
                                    Pengecekan Lagi</a>
                            @elseif('is-admin')
                            @endcan
                            <!--/.card-body -->

                            <!--/.card-footer -->
                        </div>
                        <!-- /.swiper-container -->
                    </div>
                    <!-- /column -->
                    <div class="col-lg-6">
                        <div class="post-header mb-5">
                            <h4 class="post-title display-8">Hasil Prediksi :</h4>
                            <h2 class="post-title display-5">{{ Str::ucfirst($histories->all_prediction) }}</h2>
                            <br>
                            <h4 class="post-title display-8">Tentang Artikel Sepatu :</h4>
                            <h2 class="post-title display-5">{{ Str::ucfirst($articles->name) }}</h2>
                            <p class="mb-6"><b>Brand Sepatu:</b> {{ $articles->brands->name }}</p>
                            <p class="mb-6">
                                <span class="amount"><b>Retail Price:</b> Rp.
                                    {{ number_format($articles->retail_price, 0, ',', '.') }}</span>
                            </p>
                            <p class="mb-6">
                                <span class="amount"><b>Resell Price:</b> Rp.
                                    {{ number_format($articles->resell_price, 0, ',', '.') }}</span>
                            </p>
                            <p class="mb-6"><b>Tanggal Rilis:</b>
                                {{ \Carbon\Carbon::parse($articles->release_date)->format('d F Y') }}</p>
                            <p class="mb-6">{{ $articles->description }}</p>
                        </div>
                        <!-- /.post-header -->

                        <!-- /column -->
                        <!-- /.row -->
                        <!-- /form -->
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->

        </div>
    @endsection
