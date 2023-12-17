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

    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="modalCreateAdm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Admin</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store') }}" method="post" id="formInsert">
                        @csrf
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                aria-describedby="textHelp">
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="textHelp">
                            <div id="passwordHelp" class="form-text">Email harus memiliki @</div>
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword"
                                aria-describedby="passwordHelp" minlength="8" required>
                            <div id="passwordHelp" class="form-text">Password harus memiliki setidaknya 8 karakter</div>
                            <div id="passwordHelp" class="form-text text-danger">
                            </div>
                            <div class="form-floating password-field mb-4">
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Konfirmasi Password">
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label for="loginPasswordConfirm">Konfirmasi Password</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="modalVerify()">Verifikasi Email</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditAdm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Admin</h4>
                </div>
                <div class="modal-body">
                    Update Data 1
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="updateAdmin()">Ubah Admin</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>
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
    <script>
        function modalVerify() {
            $('#formInsert').submit();
        }


        function modalCreateAdm() {
            $('#modalCreateAdm').modal('show');
        }

        function modalEditAdm(id) {
            $.get("{{ url('admin/update_admin') }}/" + id, function(data) {
                $('#modalEditAdm .modal-body').html(data);
                $('#modalEditAdm').modal('show');
            });
        }

        function modalDeleteUser(id) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus pengguna ini?',
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
                        url: '{{ route('user.deleteDataUsr') }}',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'id': id
                        },
                        success: function(data) {
                            if (data.status == 'oke') {
                                $('#tr_' + id).remove();
                                Swal.fire(
                                    'Berhasil Terhapus!',
                                    'Pelanggan berhasil terhapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Gagal menghapus pengguna. Silakan coba lagi.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus pengguna. Silakan coba lagi.',
                                'error'
                            );
                        }
                    });
                }
            });
        }


        function modalDeleteAdm(id) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus admin ini?',
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
                        url: '{{ route('user.deleteDataAdm') }}',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'id': id
                        },
                        success: function(data) {
                            if (data.status == 'oke') {
                                $('#tr_' + id).remove();
                                Swal.fire(
                                    'Berhasil Terhapus!',
                                    'Admin berhasil terhapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Gagal menghapus admin. Silakan coba lagi.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus admin. Silakan coba lagi.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function updateAdmin() {
            $('#form-update').submit();
        }

        new DataTable('#table1');
        new DataTable('#table2');
    </script>
@endsection
