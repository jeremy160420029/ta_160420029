@extends('layouts.main')
@section('content')
    <style>
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
    </style>

    <section class="wrapper bg-gray image-wrapper bg-image bg-cover" data-image-src="{{ asset('/assets/img/ic2.jpg') }}">
        <div class="container py-12 py-md-16 text-center">
            <div class="row">
                <div class="col-lg-10 col-xxl-8 mx-auto">
                    <h1 class="display-1 mb-3 text-white"
                        style="background-color: rgba(0, 0, 0, 0.8); padding: 10px; border-radius: 20px; display: inline-block;">
                        Riwayat Pengecekan</h1>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row align-items-center mb-10 position-relative zindex-1">
                <div class="col-md-8 col-lg-9 col-xl-8 col-xxl-7 pe-xl-20">
                    <h2 class="display-6">Riwayat Pengecekan Sepatu</h2>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Halaman Riwayat Pengecekan Sepatu</li>
                        </ol>
                    </nav>
                    <!-- /nav -->
                </div>
                <div class="col-md-4 col-lg-3 col-xl-4 col-xxl-5 d-flex justify-content-end">
                    <form action="{{ route('search.history') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari nama sepatu" name="search">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
            <div class="grid grid-view projects-masonry shop mb-13">
                <div class="row gx-md-8 gy-10 gy-md-13 isotope">
                    @foreach ($histories as $h)
                        <div class="project item col-md-6 col-xl-4">
                            <div class="card mx-auto" style="width: 20rem;">
                                <img src="data:image/jpeg;base64,{{ base64_encode($h->image_data) }}" class="card-img-top"
                                    alt="2x">
                                <div class="card-body">
                                    <h1 class="card-title">{{ $h->articles->name }}</h1>
                                    <h5 class="card-title">{{ $h->all_prediction }}</h5>
                                    <h5 class="card-title">{{ \Carbon\Carbon::parse($h->date)->format('d F Y || H:i:s') }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- /.row -->
            </div>
            <!-- /.grid -->
            <!-- /nav -->
        </div>
        <!-- /.container -->
    </section>
@endsection
