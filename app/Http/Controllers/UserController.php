<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| CONTROLLER USER
|--------------------------------------------------------------------------
|
| Kelola akun user (khusus admin): lihat, tambah, edit role, hapus.
*/
class UserController extends Controller
{
    // Daftar semua user
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('users.create');
    }

    // Simpan user baru (password otomatis di-hash via cast di model)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat.');
    }

    // Form edit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update data user (tanpa ubah password lewat sini)
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,user',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diedit.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}
