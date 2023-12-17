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
                        <div class="card-header">{{ __('Ganti Password') }}</div>
                        <div class="card-body">
                            <form class="text-start mb-3" method="POST" action="{{ route('user.change_password') }}">
                                @csrf
                                <div class="form-floating password-field mb-4">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Password">
                                    <span class="password-toggle"><i class="uil uil-eye"></i></span>

                                    <label for="loginPassword">Password</label>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating password-field mb-4">
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Konfirmasi Password">

                                    <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                    <label for="loginPasswordConfirm">Konfirmasi Password</label>
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill btn-login w-100 mb-2">
                                    {{ __('Ganti Password') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
