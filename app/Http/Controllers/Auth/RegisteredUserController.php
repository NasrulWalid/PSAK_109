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
            'nama_pt' => ['required', 'string'], // Validasi untuk jenis perusahaan
            'alamat_pt' => ['required', 'string'], // Validasi untuk jenis perusahaan
            'company_type' => ['required', 'string'], // Validasi untuk jenis perusahaan
            'nomor_wa' => ['required', 'string', 'regex:/^[0-9\+]{10,15}$/'], // Validasi nomor WA
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'nama_pt' => $request->nama_pt,
            'alamat_pt' => $request->alamat_pt,
            'company_type' => $request->company_type, // Jenis perusahaan
            'nomor_wa' => $request->nomor_wa,
            'email' => $request->email,
            'role' => 'admin', // Set peran (role) sebagai admin secara default
            'aktivasi' => 'aktif', // Status aktivasi langsung 'aktif'
            'password' => Hash::make($request->password),
        ]);

        // Fire Registered event
        event(new Registered($user));

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('status', 'Registrasi Berhasil, Harap Login.');
    }
}
