@extends('layouts.admin')

@section('content')
    <style>
        .table .description-cell {
            vertical-align: top;
        }

        .table {
            border-collapse: collapse;
        }

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>

    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="modalCreateArticle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Artikel</h4>
                </div>
                <div class="modal-body">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="insertArtikel()">Tambah Artikel</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="modalEditArticle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Artikel</h4>
                </div>
                <div class="modal-body">
                    Update Data 1
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-success" onclick="updateArticle()">Update Artikel</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="modalDetailArticle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Detail Artikel</h1>

                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Daftar Artikel</h5>
        <button class="btn btn-success" onclick="modalCreateArticle()">Tambah Artikel</button>
        <div class="card">
            <div class="card-body p-4">
                <table class="table text-nowrap mb-0 align-middle" border=1 id="table">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">ID</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama Artikel</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Tanggal Perilisan Artikel</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Harga Beli (Retail)</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Harga Jual (Resell)</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $a)
                            <tr id="tr_{{ $a->id }}">
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $a->id }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $a->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">
                                        {{ \Carbon\Carbon::parse($a->release_date)->format('d F Y') }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Rp {{ number_format($a->retail_price, 0, ',', '.') }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Rp {{ number_format($a->resell_price, 0, ',', '.') }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <button class="btn btn-success"
                                        onclick="modalDetailArticle({{ $a->id }})">Detail</button>
                                    <button class="btn btn-success"
                                        onclick="modalEditArticle({{ $a->id }})">Ubah</button>
                                    <button class="btn btn-danger" onclick="modalDeleteArticle({{ $a->id }})"><i
                                            class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function modalCreateArticle() {
            $.get("{{ url('admin/create_article') }}", {}, function(data, status) {
                $('#modalCreateArticle .modal-body').html(data);
                $('#modalCreateArticle').modal('show');
            });
        }

        function modalEditArticle(id) {
            $.get("{{ url('admin/edit_article') }}/" + id, function(data) {
                $('#modalEditArticle .modal-body').html(data);
                $('#modalEditArticle').modal('show');
            });
        }

        function modalDetailArticle(id) {
            let idArticle = id
            $.get("{{ url('admin/article/detail') }}/" + idArticle, function(data) {
                $("#modalDetailArticle .modal-body").html(data);
                $('#modalDetailArticle').modal('show');
            });
        }

        function modalDeleteArticle(id) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus artikel ini?',
                text: "Anda tidak bisa mengembalikan perubahan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, saya yakin',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post({
                        type: 'POST',
                        url: '{{ route('articles.deleteData') }}',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'id': id
                        },
                        success: function(data) {
                            if (data.status == 'oke') {
                                $('#tr_' + id).remove();
                                Swal.fire(
                                    'Berhasil Terhapus!',
                                    'Artikel berhasil terhapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Gagal menghapus artikel. Silakan coba lagi.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus artikel. Silakan coba lagi.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function insertArtikel() {
            $('#formInsert').submit();
        }

        function updateArticle() {
            $('#form-update').submit();
        }

        new DataTable('#table');
    </script>
@endsection
