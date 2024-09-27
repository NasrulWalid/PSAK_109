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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nama_pt' => ['required', 'string', 'max:255'],
            'nomor_wa' => ['required', 'string', 'regex:/^[0-9\+]{10,15}$/'], // validasi untuk nomor telepon
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'nama_pt' => $request->nama_pt,
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
