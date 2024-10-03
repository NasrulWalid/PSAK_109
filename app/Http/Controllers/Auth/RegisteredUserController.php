<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    // Validasi input
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'nama_pt' => ['required', 'string', 'max:255'],
        'alamat' => ['required', 'string', 'max:255'], // Validasi untuk alamat
        'nomor_wa' => ['required', 'string', 'regex:/^[0-9\+]{10,15}$/'], // Validasi untuk nomor telepon
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Ambil nama PT dan alamat dari input
    $namaPt = $request->nama_pt;
    $alamatPt = $request->alamat;

    // Cek apakah nama PT sudah ada di tabel tbl_pt
    $ptExists = DB::table('tbl_pt')->where('nama_pt', $namaPt)->exists();

    // Jika nama PT belum ada, tambahkan ke tbl_pt
    if (!$ptExists) {
        DB::table('tbl_pt')->insert([
            'id_pt' => uniqid(), // Generate ID unik
            'nama_pt' => $namaPt,
            'alamat' => $alamatPt, // Masukkan alamat ke dalam tabel
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
        'password' => Hash::make($request->password),
    ]);

    // Fire Registered event
    event(new Registered($user));

    // Redirect to login page
    return redirect()->route('login')->with('status', 'Registrasi Berhasil, Harap Login.');
}
}
