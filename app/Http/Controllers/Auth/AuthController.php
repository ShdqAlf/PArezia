<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PelamarModel;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email salah, berikan tanda @',
            'password.required' => 'Password wajib diisi',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            if ($user->email_verified_at === null) {
                if ($user->role == 'Admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role == 'Staff') {
                    return redirect()->route('staff.dashboard');
                } elseif ($user->role == 'Pimpinan') {
                    return redirect()->route('pimpinan.dashboard');
                } else {
                    Auth::logout();
                    alert()->error('Role tidak ditemukan');
                }
            } else {
                if ($user->role == 'Pelamar') {
                    return redirect()->route('pelamar.dashboard');
                } else {
                    Auth::logout();
                    alert()->error('Email harus terverifikasi');
                    return redirect()->back();
                }
            }
        } else {
            alert()->error('Email atau Password salah');
            return redirect()->back();
        }
    }



    // register pelamar
    public function proses_register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'nama' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'email.email' => 'Format email salah, berikan tanda @',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 ch',
        ]);

        $userexs = User::where('email', $request->input('email'))->first();
        if ($userexs) {
            alert()->error('Email sudah terdaftar');
            return redirect()->back();
        }

        $email = $request->input('email');
        $password = $request->input('password');
        $nama = $request->input('nama');

        $user = User::create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        if ($user) {
            if (!empty($nama)) {
                $pelamar = PelamarModel::create([
                    'nama' => $nama,
                    'user_id' => $user->id,
                ]);
                if ($pelamar) {
                    event(new Registered($user));
                    alert()->success('Registrasi Berhasil Silahkan Verifikasi Email');
                    if (Auth::login($user)) {
                        alert()->success('Email sudah terverifikasi');
                        return redirect()->back();
                    }
                    return redirect()->route('');
                } else {
                    $user->delete();
                    alert()->error('Registrasi Gagal');
                    return redirect()->back();
                }
            } else {
                $user->delete();
                alert()->error('Nama wajib diisi');
                return redirect()->back();
            }
        } else {
            alert()->error('Registrasi Gagal');
            return redirect()->back();
        }
    }


    // random ini
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function home()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Pelamar') {
                return redirect()->route('pelamar.dashboard');
            } elseif (Auth::user()->role == 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 'Pimpinan') {
                return redirect()->route('pimpinan.dashboard');
            } elseif (Auth::user()->role == 'Staff') {
                return redirect()->route('staff.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login');
            }
        } else {
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
