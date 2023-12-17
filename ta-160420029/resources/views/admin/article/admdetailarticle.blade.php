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

<div class="card-body">
    <div class="card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-sm" border=1 id="table">
                    <thead class="text-dark fs-4">
                        @foreach ($articleDetail as $ad)
                            <tr>
                                <td colspan="4">Nama Artikel</td>
                                <td>{{ $ad->name }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">Tanggal Perilisan Artikel</td>
                                <td class="description-cell">
                                    {{ \Carbon\Carbon::parse($ad->release_date)->translatedFormat('j F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">Harga Beli (Retail)</td>
                                <td class="description-cell">
                                    {{ 'Rp ' . number_format($ad->retail_price, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">Harga Jual (Resell)</td>
                                <td class="description-cell">
                                    {{ 'Rp ' . number_format($ad->resell_price, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="description-cell">Deskripsi</td>
                                <td>{{ $ad->description }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">Nama Brand</td>
                                <td class="description-cell">{{ $ad->brands->name }}</td>
                            </tr>
                        @endforeach
                    </thead>
                </table>
                <button class="btn btn-success" onclick="modalAddImage()">Tambah Gambar
                    Artikel</button>
                <table class="table text-nowrap mb-0 align-middle" border=1 id="table">
                    <tbody>
                        <th class="border-bottom-0">
                            <h4 class="card-title fw-semibold mb-4">Daftar Gambar Artikel</h4>
                        </th>
                        <th class="border-bottom-0">
                            <h4 class="card-title fw-semibold mb-4">Aksi</h4>
                        </th>
                    </tbody>
                    <tfoot>
                        @foreach ($image as $img)
                            <tr>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($img->image)
                                            <?php
                                            $compressedImage = Image::make($img->image)
                                                ->resize(200, null, function ($constraint) {
                                                    $constraint->aspectRatio();
                                                })
                                                ->encode('data-url');
                                            ?>
                                            <img src="{{ $compressedImage }}" alt="Image" class="img-fluid" />
                                        @else
                                            <span class="badge bg-danger rounded-3 fw-semibold">No Image</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="modalDeleteImage({{ $img->id }})"><i
                                            class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Gambar Artikel</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('images.store') }}" id="formInsert" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    @foreach ($articleDetail as $ad)
                        <div class="mb-2">
                            <label for="articleName" class="form-label">Nama Artikel</label>
                            <input type="text" id="articleName" class="form-control" readonly
                                value="{{ $ad->name }}">
                        </div>

                        <!-- Add a hidden input field to store the article ID -->
                        <input type="hidden" name="articles_id" id="articleId" value="{{ $ad->id }}">
                        <div class="mb-2">
                            <label class="form-label">Gambar Artikel</label>
                            <input type="file" class="form-control" id="img" name="img">
                        </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="insertImage()">Tambah Gambar Artikel</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function modalAddImage() {
        $("#modalAddImage").modal("show");
    }

    function insertImage() {
        $('#formInsert').submit();
    }

    function modalDeleteImage(id) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus gambar ini?',
            text: "Anda tidak bisa mengembalikan perubahan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, saya yakin',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('images.deleteData') }}',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'id': id
                    },
                    success: function(data) {
                        if (data.status == 'oke') {
                            $('#tr_' + id).remove();
                            location.reload();
                            Swal.fire(
                                'Berhasil Terhapus!',
                                'Gambar berhasil terhapus.',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Gagal menghapus gambar. Silakan coba lagi.',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menghapus gambar. Silakan coba lagi.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
