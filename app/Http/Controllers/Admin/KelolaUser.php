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
        return view('admin.kelolauser', compact('users'));
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
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.kelolauser.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function hapusPengguna(User $user)
    {
        $user->delete();
        return redirect()->route('admin.kelolauser.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function edit(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $user->update([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.kelolauser.index')->with('success', 'Pengguna berhasil diperbarui.');
    }
}
