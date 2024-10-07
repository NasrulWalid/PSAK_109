<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class ManajemenController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $all_users = User::with('pt')->get(); // Eager load pt relationship
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
        // Validasi form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nama_pt' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'nomor_wa' => ['required', 'string', 'regex:/^[0-9\+]{10,15}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['sometimes', 'string'], // Menggunakan 'sometimes' agar validasi tidak gagal jika role tidak dikirim
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        // Logika untuk menyimpan user ke dalam database
        try {
            $namaPt = $request->nama_pt;
            $alamatPt = $request->alamat;

            // Cek apakah nama PT sudah ada di tabel tbl_pt
            $ptExists = DB::table('tbl_pt')->where('nama_pt', $namaPt)->exists();
    
            // Jika nama PT belum ada, tambahkan ke tbl_pt
            if (!$ptExists) {
                DB::table('tbl_pt')->insert([
                    'id_pt' => uniqid(), // Generate ID unik
                    'nama_pt' => $namaPt,
                    'alamat' => $alamatPt,
                ]);
            }
    
            // Ambil ID PT yang sesuai
            $ptId = DB::table('tbl_pt')->where('nama_pt', $namaPt)->value('id_pt');
    
            // Buat pengguna baru
            $user = User::create([
                'name' => $request->name,
                'id_pt' => $ptId, // Gunakan ID PT yang sesuai
                'nomor_wa' => $request->nomor_wa,
                'email' => $request->email,
                'role' => $request->role, // Gunakan nilai role yang dikirim dari form
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
            'nama_pt' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_wa' => 'required|string|regex:/^[0-9\+]{10,15}$/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user_id, // Update email, kecuali yang sama
            'role' => 'sometimes|string',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Gunakan array
        ]);
    
        try {
            // Ambil user dan PT terkait
            $user = User::findOrFail($request->user_id);
            $pt = DB::table('tbl_pt')->where('id_pt', $user->id_pt)->first();
    
            // Update nama PT dan alamat jika ada perubahan
            if ($pt) {
                DB::table('tbl_pt')->where('id_pt', $user->id_pt)->update([
                    'nama_pt' => $request->nama_pt,
                    'alamat' => $request->alamat,
                ]);
            }
    
            // Update user data, hanya update password jika diisi
            $user->update([
                'name' => $request->name,
                'nomor_wa' => $request->nomor_wa,
                'email' => $request->email,
                'role' => $request->role,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
    
            // Redirect ke halaman user manajemen dengan pesan sukses
            return redirect('/usermanajemen')->with('success', 'User berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }
    
    public function loadedit($id){
        $user = User::with('pt')->find($id);

        return view('superadmin.edit-user', compact('user'));
    }

    public function delete($id){
        try {
            User::where('id',$id)->delete();
            return redirect('/usermanajemen')->with('success', 'User Deleted Success');
        } catch (\Exception $e) {
            return redirect('/usermanajemen')->with('fail',$e->getMessage());
        }
    }
}
