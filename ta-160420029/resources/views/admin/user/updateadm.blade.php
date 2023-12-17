<form action="{{ route('admin.updateAdmStaff', $admin->id) }}" method="post" id="form-update">
    @method('POST')
    @csrf
    <div class="form-floating mb-4">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
            value="{{ $admin->username }}" required autocomplete="username" autofocus placeholder="Username">
        <label for="loginUsername">Username</label>

        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
    <div class="form-floating mb-4">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ $admin->email }}" required autocomplete="email" placeholder="E-mail">
        <label for="loginEmail">E-mail</label>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-floating password-field mb-4">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password" placeholder="Password">
        <span class="password-toggle"><i class="uil uil-eye"></i></span>

        <label for="loginPassword">Password</label>

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-floating password-field mb-4">
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password" placeholder="Konfirmasi Password">
        <span class="password-toggle"><i class="uil uil-eye"></i></span>
        <label for="loginPasswordConfirm">Konfirmasi Password</label>
    </div>
</form>
