<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Mail\MyMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showVerificationForm()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric|digits:4',
        ]);

        $verificationCode = $request->input('verification_code');
        $storedVerificationCode = session('verification_code');

        if ($verificationCode == $storedVerificationCode) {
            $user = User::create([
                'username' => $request->session()->get('username'),
                'email' => $request->session()->get('email'),
                'password' => Hash::make($request->session()->get('password')),
                'role' => 'user',
            ]);

            session()->forget('username');
            session()->forget('password');
            session()->forget('email');
            session()->forget('verification_code');

            return redirect()->route('login')->with('message', 'Verifikasi berhasil. Silakan login.');
        } else {
            session()->forget('username');
            session()->forget('password');
            session()->forget('email');
            session()->forget('verification_code');

            return redirect()->route('register')->with('message', 'Kode verifikasi tidak valid. Silakan daftar ulang.');
        }
    }


    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $userUsername = $request->input('username');
        $userEmail = $request->input('email');
        $userPassword = $request->input('password');
        $verificationCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $request->session()->put('verification_code', $verificationCode);
        $request->session()->put('email', $userEmail);
        $request->session()->put('username', $userUsername);
        $request->session()->put('password', $userPassword);

        $details = [
            'title' => 'Verifikasi Email dari QC System',
            'body' => 'Kode verifikasi Anda: ' . $verificationCode,
        ];

        Mail::to($userEmail)->send(new MyMail($details));

        return redirect()->route('verify')->with('message', 'Verifikasi Email Anda.');
    }
}
