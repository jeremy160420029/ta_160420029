@extends('layouts.main')

@section('title')
    {{ $article->name }} | QC System
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
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ url('articles') }}">Halaman Artikel
                                Sepatu</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ $article->name }}</li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Gambar Produk</li>
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
                    <h2 class="post-title display-5" style="text-align: center">{{ Str::ucfirst($article->name) }}</h2>
                    @foreach ($images as $image)
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <section class="wrapper image-wrapper bg-image bg-cover text-white"
                                        data-image-src="data:image/jpeg;base64,{{ base64_encode($image->image) }}"
                                        alt="Image">
                                        <div class="container py-14 py-md-21">
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-body text-center">
                    @can('is-user')
                        <a href="{{ route('preview', $article->id) }}" class="btn btn-primary">Lakukan Pengecekan</a>
                    @else
                        @can('is-admin')
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Pengecekan</a>
                        @endcan
                    @endcan
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
