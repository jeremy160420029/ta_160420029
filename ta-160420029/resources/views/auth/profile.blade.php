@extends('layouts.main')

@section('content')
    <section class="wrapper bg-light">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container my-8">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Profil Saya') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.updateProfile') }}">
                                @csrf
                                <div class="form-group my-2">
                                    <label for="username">Username</label>
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ auth()->user()->username }}" required autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group my-2">
                                    <label for="email">Email</label>
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ auth()->user()->email }}" required autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if (session('update'))
                                    <button type="button" class="btn btn-secondary" id="verificationEmail">Verifikasi
                                        Email</button>
                                @endif
                                <button type="submit" class="btn btn-primary my-2">
                                    {{ __('Ubah Profil') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h1>Verifikasi Email</h1>
                    <form id="verificationForm" method="POST" action="{{ route('profile.verify') }}">
                        @csrf
                        <div class="form-group">
                            <label for="userEmail">Email Sebelum:</label>
                            <p class="form-control-static">{{ Auth::user()->email }}</p>
                            <label for="userEmail">Email Perubahan:</label>
                            <p class="form-control-static">{{ session('email') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="verificationCode">Masukkan Kode Verifikasi</label>
                            <input type="text" class="form-control" id="verificationCode" name="verification_code"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Verifikasi</button>
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#verificationEmail').on('click', function() {
                $('#verificationModal').modal('show');
            });
        });
    </script>
@endsection
