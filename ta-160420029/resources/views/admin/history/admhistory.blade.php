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

    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Daftar Riwayat Pengecekan</h5>
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
                                <h6 class="fw-semibold mb-0">Gambar Prediksi</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Hasil Prediksi</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Tanggal Prediksi</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Username Pengguna</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $h)
                            <tr id="tr_{{ $h->id }}">
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $h->id }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $h->articles->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($h->image_data)
                                            <?php
                                            $compressedImage = Image::make($h->image_data)
                                                ->resize(300, null, function ($constraint) {
                                                    $constraint->aspectRatio();
                                                })
                                                ->encode('data-url');
                                            ?>
                                            <a href="{{ 'detail', $h->id }}" data-bs-toggle="modal"
                                                data-bs-target="#imageModal"
                                                onclick="openImageModal('{{ $h->id }}')">
                                                <img src="{{ $compressedImage }}" alt="Image"
                                                    class="img-fluid clickable-image"
                                                    data-original="{{ $h->image_data }}" />
                                            </a>
                                        @else
                                            <span class="badge bg-danger rounded-3 fw-semibold">No Image</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $h->all_prediction }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">
                                        {{ \Carbon\Carbon::parse($h->date)->format('d F Y, H:i:s') }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $h->users->username }}</h6>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Detail Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function openImageModal(historyId) {
            let id = historyId;

            $.get("{{ url('admin/image/detail') }}/" + id, function(data) {
                $("#imageModal .modal-body").html(data);
                $('#imageModal').modal('show');
            });
        }

        new DataTable('#table');
    </script>
@endsection
