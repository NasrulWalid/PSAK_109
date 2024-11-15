<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // Ambil id_pt dari pengguna yang sedang masuk
    $loggedInUser = $request->user();
    $idPt = $loggedInUser->id_pt; // pastikan id_pt tersedia di model pengguna
// Tampilkan nilai id_pt

    // Super Admin
    if ($loggedInUser->role == 'superadmin') {
        return redirect()->intended(route('superadmin.dashboard', ['id_pt' => $idPt], absolute: false));
    }
    // Admin
    else if ($loggedInUser->role == 'admin') {
        return redirect()->intended(route('admin.dashboard', ['id_pt' => $idPt], absolute: false));
    }

    return redirect()->intended(route('dashboard', ['id_pt' => $idPt], absolute: false));
}



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
