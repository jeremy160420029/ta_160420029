@extends('layouts.main')

@section('title')
    Halaman Preview Pengecekan Sepatu | QC System
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
                        <li class="breadcrumb-item active" aria-current="page">Halaman Preview</li>
                    </ol>
                </nav>
                <!-- /nav -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->
        <section class="wrapper bg-light">
            <div class="container py-14 py-md-16">
                <div class="row justify-content-center align-items-center gx-md-8 gx-xl-12 gy-8">
                    <div class="col-lg-6">
                        <div class="card mx-auto">
                            <div class="card-body text-center">
                                <img src="http://192.168.184.65:8000/" class="img-fluid" />
                                <br>
                                @can('is-user')
                                    <a href="{{ route('check', $articles->id) }}" class="btn btn-primary mt-3">Ambil Gambar
                                        Pengecekan</a>
                                @elseif('is-admin')
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /section -->
    </section>
@endsection
