<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function index()
    {
        $users = User::all()->where('role', 'user');
        $admins = User::all()->where('role', 'admin');
        return view('admin.user.admuser', compact('users', 'admins'));
    }

    public function store(Request $request)
    {
        $email = User::where("email", "=", $request->email)->first();
        if ($email) {
            return back()->withInput()->with("message", "Sudah ada");
        }

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
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

            return redirect()->route('add.adm')->with('message', 'Cek Email Anda untuk melakukan Verifikasi Email.');
        }
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
                'role' => 'admin',
            ]);

            session()->forget('username');
            session()->forget('password');
            session()->forget('email');
            session()->forget('verification_code');

            return redirect()->route('admuser.index')->with('message', 'Kode Verifikasi valid, Akun Admin berhasil dibuat.');
        } else {
            session()->forget('username');
            session()->forget('password');
            session()->forget('email');
            session()->forget('verification_code');

            return redirect()->route('admuser.index')->with('message', 'Kode Verifikasi tidak valid, Akun Admin tidak berhasil dibuat.');
        }
    }

    public function verifyUpdtAdm(Request $request)
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

            return redirect()->route('admuser.index')->with('message', 'Kode Verifikasi valid, Email berhasil diubah.');
        } else {
            session()->forget('email');
            session()->forget('verification_code');

            return redirect()->route('admuser.index')->with('message', 'Kode Verifikasi tidak valid, Email tidak berhasil diubah.');
        }
    }

    public function updateAdm($id)
    {
        $admin = User::where("id", "=", $id)->first();
        return view('admin.user.updateadm', compact('admin'));
    }

    public function addAdmVerify()
    {
        $users = User::all()->where('role', 'user');
        $admins = User::all()->where('role', 'admin');
        return view('admin.user.admverifemail', compact('users', 'admins'));
    }

    public function updateAdmVerify()
    {
        $users = User::all()->where('role', 'user');
        $admins = User::all()->where('role', 'admin');
        return view('admin.user.updateverifemail', compact('users', 'admins'));
    }

    public function updateAdmStaff(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => $request->filled('password') ? 'required|string|min:8|confirmed' : '',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::where("id", "=", $id)->first();

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

                return redirect()->route('update.adm')->with('message', 'Lakukan Verifikasi Email untuk merubah Email Anda. Cek Email Anda.');
            } else {
                $user->username = $request->username;

                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }

                $user->save();

                return redirect()->route("admuser.index")->with("message", "Ubah Admin Berhasil.");
            }
        }
    }

    public function deleteDataAdm(Request $request)
    {
        $id = $request->get('id');
        $authenticatedUser = Auth::user();

        if ($authenticatedUser && $authenticatedUser->id == $id) {
            return response()->json(array(
                'status' => 'error',
                'msg' => 'Admin tidak bisa menghapus diri sendiri'
            ), 400);
        }

        $data = User::find($id);
        $data->delete();

        return response()->json(array(
            'status' => 'oke',
            'msg' => 'Admin berhasil dihapus'
        ), 200);
    }

    public function deleteDataUsr(Request $request)
    {
        $id = $request->get('id');
        $dataUsr = User::find($id);
        $dataHistory = History::where("users_id", $id);
        $dataHistory->delete();
        $dataUsr->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'User berhasil dihapus'
        ), 200);
    }
}
