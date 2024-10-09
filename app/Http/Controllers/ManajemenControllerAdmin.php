<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ManajemenControllerAdmin extends Controller
{
    // Menampilkan daftar pengguna yang memiliki nama_pt yang sama dengan admin
    public function index()
    {
        $admin = auth()->user();
        $all_users = User::where('nama_pt', $admin->nama_pt)->get();
        return view('admin.usermanajemen', compact('all_users'));
    }

    // Menampilkan halaman tambah user
    public function tambahuseradmin()
    {
        return view('admin.tambahuser');
    }

    // Fungsi untuk menambahkan user baru
    public function AddUserAdmin(Request $request): RedirectResponse
    {
    //     // Dump semua data yang dikirim dari form
    // dump('Data yang dikirim:', $request->all());
        // Validasi form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nomor_wa' => ['required', 'string', 'regex:/^[0-9\+]{10,15}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'string'], 
            'company_type' => ['required', 'string'], // Validasi untuk company_type
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nama_pt' => ['required', 'string'], // Validasi untuk nama_pt
            'alamat_pt' => ['required', 'string'], // Validasi untuk alamat_pt
        ]);

    // // Dump setelah validasi berhasil
    // dump('Validasi berhasil.');
        try {
        //     // Dump sebelum menyimpan user
        // dump('Sebelum menyimpan user.');
            // Buat user baru dengan nama_pt dan alamat_pt dari admin yang sedang login
            $user = User::create([
                'name' => $request->name,
                'nomor_wa' => $request->nomor_wa,
                'email' => $request->email,
                'role' => $request->role,
                'company_type' => $request->company_type, // Tambahkan ini
                'nama_pt' => auth()->user()->nama_pt, // Ambil dari admin yang sedang login
                'alamat_pt' => auth()->user()->alamat_pt, // Ambil dari admin yang sedang login
                'password' => Hash::make($request->password),
            ]);

            // Trigger event Registered jika perlu
            event(new Registered($user));

            // Redirect ke halaman user manajemen dengan pesan sukses
            return redirect()->route('admin.usermanajemen')->with('status', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            // dd('Error saat menyimpan user: ' . $e->getMessage());
            return redirect()->route('admin.add.user')->with('fail', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    // Menampilkan halaman edit user
    public function loadeditadmin($id)
    {
        $admin = auth()->user();
        $user = User::where('id', $id)->where('nama_pt', $admin->nama_pt)->firstOrFail();
        return view('admin.edit-user', compact('user'));
    }

    // Fungsi untuk mengedit user
    public function EditUserAdmin(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nomor_wa' => ['required', 'string', 'regex:/^[0-9\+]{10,15}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'role' => ['required', 'string'],
            'company_type' => ['required', 'string'], // Validasi untuk company_type
            'nama_pt' => ['required', 'string'],
            'alamat_pt' => ['required', 'string'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Password optional
        ]);

        try {
            $admin = auth()->user();
            $user = User::where('id', $id)->where('nama_pt', $admin->nama_pt)->firstOrFail();
            $user->update([
                'name' => $request->name,
                'nomor_wa' => $request->nomor_wa,
                'email' => $request->email,
                'role' => $request->role,
                'company_type' => $request->company_type, // Tambahkan ini
                'nama_pt' => $request->nama_pt,
                'alamat_pt' => $request->alamat_pt,
            ]);

            // Jika password diisi, update password
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
                $user->save();
            }

            return redirect()->route('admin.usermanajemen')->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.usermanajemen')->with('fail', 'Gagal memperbarui user: ' . $e->getMessage());
        }
    }

    // Fungsi untuk menghapus user
    public function deleteadmin($id)
    {
        try {
            $admin = auth()->user();
            $user = User::where('id', $id)->where('nama_pt', $admin->nama_pt)->firstOrFail();
            $user->delete();
            return redirect()->route('admin.usermanajemen')->with('success', 'User Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.usermanajemen')->with('fail', $e->getMessage());
        }
    }
}
