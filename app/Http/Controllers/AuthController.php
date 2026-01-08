<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // === LOGIN ===
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Redirect ke home/dashboard
        }

        // Jika Gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // === REGISTER ===
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // 1. Validate all fields (Step 1 & Step 2)
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'major' => 'nullable|string|max:255',
        'batch' => 'nullable|integer', // Validate batch
        
        // Step 2 Fields
        'gpa' => 'nullable|string|max:10', // GPA usually short string or float
        'interest' => 'nullable|string|max:255',
        'skills' => 'nullable|string',
        'wishlist' => 'nullable|string',
    ]);

    // 2. Save to Database
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'major' => $request->major,
        'batch' => $request->batch,
        
        // Map form inputs to DB columns
        'gpa' => $request->gpa,
        'interest' => $request->interest,
        'skills' => $request->skills,
        'wishlist' => $request->wishlist,
    ]);

    // 3. Auto Login
    Auth::login($user);

    return redirect('/');
}

    // === LOGOUT ===
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}