<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('auth.profile');
    }

    public function showProfilePass()
    {
        return view('auth.changepassword');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric|digits:4',
        ]);

        $userId = auth()->id();

        $user = User::where("id", "=", $userId)->first();

        $verificationCode = $request->input('verification_code');
        $storedVerificationCode = session('verification_code');

        if ($verificationCode == $storedVerificationCode) {
            $user->email = $request->session()->get('email');
            $user->save();

            session()->forget('email');
            session()->forget('verification_code');

            return redirect()->route('profile')->with('success', 'Kode Verifikasi valid, Email berhasil diubah.');
        } else {
            session()->forget('email');
            session()->forget('verification_code');

            return redirect()->route('profile')->with('success', 'Kode Verifikasi tidak valid, Email tidak berhasil diubah.');
        }
    }

    public function updateProfile(Request $request)
    {
        $userId = auth()->id();

        $user = User::where("id", "=", $userId)->first();

        if ($request->email !== $user->email) {
            $verificationCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $userEmail = $request->input('email');

            $details = [
                'title' => 'Verifikasi Email dari QC System',
                'body' => 'Kode verifikasi Anda: ' . $verificationCode,
            ];

            Mail::to($userEmail)->send(new MyMail($details));

            $request->session()->put('verification_code', $verificationCode);
            $request->session()->put('email', $userEmail);

            return redirect()->route('profile')->with([
                'success' => 'Lakukan Verifikasi Email untuk merubah Email',
                'update'    => 'Ubah Profil',
            ]);
        } else {
            $user->username = $request->username;
            $user->save();

            return redirect()->route('profile')->with('success', 'Profil berhasil di ubah.');
        }
    }


    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        $userId = auth()->id();

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::where("id", "=", $userId)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route("change_password")->with("success", "Password berhasil di ganti.");
        }
    }
}
