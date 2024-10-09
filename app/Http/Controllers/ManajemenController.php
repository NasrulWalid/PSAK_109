<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ManajemenController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $all_users = User::all(); // Ambil semua pengguna tanpa relasi ke PT
        return view('superadmin.usermanajemen', compact('all_users'));
    }

    // Menampilkan halaman tambah user
    public function tambahuser()
    {
        return view('superadmin.tambahuser');
    }

    // Fungsi untuk menambahkan user baru
    public function AddUser(Request $request): RedirectResponse
    {
        // dump('Data yang dikirim:', $request->all());
        // Validasi form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nama_pt' => ['required', 'string', 'max:255'], // Validasi untuk nama_pt
            'alamat_pt' => ['required', 'string', 'max:255'], // Validasi untuk alamat_pt
            'nomor_wa' => ['required', 'string', 'regex:/^[0-9\+]{10,15}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string'], // Menggunakan 'sometimes' agar validasi tidak gagal jika role tidak dikirim
            'company_type' => ['required', 'string'], // Validasi untuk company_type
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Logika untuk menyimpan user ke dalam database
        try {
            // Buat pengguna baru
            $user = User::create([
                'name' => $request->name,
                'nama_pt' => $request->nama_pt, // Tambahkan nama_pt
                'alamat_pt' => $request->alamat_pt, // Tambahkan alamat_pt
                'nomor_wa' => $request->nomor_wa,
                'email' => $request->email,
                'role' => $request->role, // Gunakan nilai role yang dikirim dari form
                'company_type' => $request->company_type, // Tambahkan company_type
                'password' => Hash::make($request->password),
            ]);

            // Fire Registered event
            event(new Registered($user));

            // Redirect to user management page with success message
            return redirect('/usermanajemen')->with('status', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect('/tambahuser')->with('fail', $e->getMessage());
        }
    }

    public function EditUser(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_wa' => 'required|string|regex:/^[0-9\+]{10,15}$/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user_id, // Update email, kecuali yang sama
            'role' => 'required|string',
            'company_type' => 'required|string', // Validasi untuk company_type
            'nama_pt' => 'required|string|max:255', // Validasi untuk nama_pt
            'alamat_pt' => 'required|string|max:255', // Validasi untuk alamat_pt
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Gunakan array
        ]);

        try {
            // Ambil user terkait
            $user = User::findOrFail($request->user_id);

            // Update user data, hanya update password jika diisi
            $user->update([
                'name' => $request->name,
                'nomor_wa' => $request->nomor_wa,
                'email' => $request->email,
                'role' => $request->role,
                'company_type' => $request->company_type, // Update company_type
                'nama_pt' => $request->nama_pt, // Update nama_pt
                'alamat_pt' => $request->alamat_pt, // Update alamat_pt
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            // Redirect ke halaman user manajemen dengan pesan sukses
            return redirect('/usermanajemen')->with('success', 'User berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    public function loadedit($id)
    {
        // Ambil user berdasarkan ID tanpa relasi
        $user = User::findOrFail($id);

        return view('superadmin.edit-user', compact('user'));
    }

    public function delete($id)
    {
        try {
            User::where('id', $id)->delete();
            return redirect('/usermanajemen')->with('success', 'User Deleted Success');
        } catch (\Exception $e) {
            return redirect('/usermanajemen')->with('fail', $e->getMessage());
        }
    }
}