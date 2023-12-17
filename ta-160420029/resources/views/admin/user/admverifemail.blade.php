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

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="modal fade" id="verificationAdmin" tabindex="-1" role="dialog" aria-labelledby="verificationAdminLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h1>Verifikasi Email</h1>
                    <p class="lead mb-6 text-start">Periksa Email yang telah Anda isi untuk mengetahui Kode Verifikasi Email
                        milik Anda.</p>
                    <form class="text-start mb-3" method="POST" action="{{ route('add') }}">
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
                                {{ __('Tambah Admin') }}
                            </button>
                            <a href="{{ route('admuser.index') }}"
                                class="btn btn-secondary rounded-pill btn-login w-100 mb-2">
                                {{ __('Kembali ke Halaman Pengguna/Admin') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Daftar Pengguna</h5>
        <div class="card">
            <div class="card-body p-4">
                <table class="table text-nowrap mb-0 align-middle" border=1 id="table1">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">ID</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Username Pengguna</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email Pengguna</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr id="tr_{{ $u->id }}">
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $u->id }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $u->username }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $u->email }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <button class="btn btn-danger" onclick="modalDeleteUser({{ $u->id }})"><i
                                            class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Daftar Admin</h5>
        <button class="btn btn-success" onclick="modalCreateAdm()">Tambah Admin</button>
        <div class="card">
            <div class="card-body p-4">
                <table class="table text-nowrap mb-0 align-middle" border=1 id="table2">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">ID</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Username Admin</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email Admin</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $a)
                            <tr id="tr_{{ $a->id }}">
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $a->id }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $a->username }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $a->email }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <button class="btn btn-success"
                                        onclick="modalEditAdm({{ $a->id }})">Ubah</button>
                                    <button class="btn btn-danger" onclick="modalDeleteAdm({{ $a->id }})"><i
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#verificationAdmin').modal('show');

            $('#verificationAdmin').on('hidden.bs.modal', function() {
                window.location.href = '{{ route('admuser.index') }}';
            });

            new DataTable('#table1');
            new DataTable('#table2');
        });
    </script>
@endsection
