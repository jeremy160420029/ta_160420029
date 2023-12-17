@extends('layouts.main')

@section('title', 'Halaman Utama | QC System')

@section('content')

    <section class="wrapper bg-gradient-primary">
        <div class="container pt-10 pt-md-14">
            <div class="row gx-2 gy-10 align-items-center">
                <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 text-center text-lg-start order-2 order-lg-0"
                    data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 mb-5 mx-md-10 mx-lg-0">Selamat datang di QC System, tempat dimana Anda dapat
                        mengetahui dan memeriksa
                        kualitas dari produk sepatu Anda sesuai dengan yang diinginkan. <br> <span
                            class="typer text-primary text-nowrap" data-delay="100"
                            data-words="Nike Air Jordan 1 High University Blue.,Nike Air Force 1 Triple White."></span><span
                            class="cursor text-primary" data-owner="typer"></span></h1>
                    <div class="d-flex justify-content-center justify-content-lg-start mb-4" data-cues="slideInDown"
                        data-group="page-title-buttons" data-delay="900">
                        <span><a class="btn btn-primary btn-icon btn-icon-start rounded-pill me-2"
                                href="{{ url('processes') }}">Lakukan Pengecekan Sekarang</a></span>
                    </div>
                </div>
                <!-- /column -->
                <div class="col-lg-5 ms-auto position-relative">
                    <div class="row g-4">
                        <div class="col-4 d-flex flex-column ms-auto" data-cues="fadeIn" data-group="col-start"
                            data-delay="900">
                            <div class="ms-auto mt-4"><img class="img-fluid rounded shadow-lg"
                                    src="{{ asset('assets/img/ic1.jpg') }}" srcset="{{ asset('assets/img/ic1.jpg') }} 2x"
                                    alt="" /></div>
                            <div><img class="img-fluid rounded shadow-lg mt-4 w-100" src="{{ asset('assets/img/ic2.jpg') }}"
                                    srcset="{{ asset('assets/img/ic2.jpg') }} 2x" alt="" /></div>
                        </div>
                        <!-- /column -->
                        <div class="col-4" data-cues="fadeIn" data-group="col-middle">
                            <div class="ms-auto mt-6"><img class="img-fluid rounded shadow-lg"
                                    src="{{ asset('assets/img/ic3.jpg') }}" srcset="{{ asset('assets/img/ic3.jpg') }} 2x"
                                    alt="" /></div>
                            <div><img class="img-fluid rounded shadow-lg mt-4" src="{{ asset('assets/img/ic4.jpg') }}"
                                    srcset="{{ asset('assets/img/ic4.jpg') }} 2x" alt="" /></div>
                            <div class="mt-4 mb-10"><img class="img-fluid rounded shadow-lg"
                                    src="{{ asset('assets/img/ic5.png') }}" srcset="{{ asset('assets/img/ic5.png') }} 2x"
                                    alt="" /></div>
                        </div>
                        <!-- /column -->
                        <div class="col-4 d-flex flex-column" data-cues="fadeIn" data-group="col-end" data-delay="900">
                            <div class="ms-auto mt-4"><img class="img-fluid rounded shadow-lg"
                                    src="{{ asset('assets/img/ic6.jpg') }}" srcset="{{ asset('assets/img/ic6.jpg') }} 2x"
                                    alt="" /></div>
                            <div class="mt-4 mb-10"><img class="img-fluid rounded shadow-lg"
                                    src="{{ asset('assets/img/ic7.jpg') }}" srcset="{{ asset('assets/img/ic7.jpg') }} 2x"
                                    alt="" /></div>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <?php
    // // Ambil gambar dari database
    // $image = DB::table('histories')
    //     ->where('id', 14)
    //     ->first();

    // // Konversi blob ke gambar
    // $decodedImage = base64_encode($image->image_data); // Ubah jika perlu, tergantung pada tipe data BLOB Anda

    // // Tampilkan gambar di halaman Blade Laravel
    // echo '<img src="data:image/jpeg;base64,' . $decodedImage . '" />';
    ?>

    <br><br>
@endsection
