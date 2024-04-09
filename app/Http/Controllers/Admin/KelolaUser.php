<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class KelolaUser extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.kelolauser');
    }

    public function tambahPengguna(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'ulangi_password' => 'required|same:password',
            'role' => 'required',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('kelolauser.index')->with('success', 'New user has been added.');
    }
}
