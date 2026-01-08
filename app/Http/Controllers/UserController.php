<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Major; 
use App\Models\Skill;

class UserController extends Controller
{
    public function account()
{
    // 1. Load relasi 'userSkills' (Bukan 'skills' biasa karena bentrok)
    $user = Auth::user()->load('userSkills');
    
    // 2. Ambil semua Major beserta Skills-nya (Untuk Dropdown & Grouping Skill)
    $majors = \App\Models\Major::with('skills')->get(); 

    return view('user.account', [
        'user' => $user,
        'majors' => $majors
    ]);
}

public function updateAccount(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email_username' => 'required|string|max:100',
        'phone_number' => 'nullable|string',
        'major' => 'nullable|string', // Tetap string karena kita simpan nama jurusannya
        'batch' => 'nullable|numeric',
        'gpa' => 'nullable|numeric|between:0,4.00',
        'date_of_birth' => 'nullable|date',
        'photo' => 'nullable|image|max:2048',
        'cv_file' => 'nullable|mimes:pdf|max:5120',
        'portfolio_file' => 'nullable|mimes:pdf|max:5120',
        
        // Validasi Array Skills
        'skills' => 'nullable|array',
        'skills.*' => 'exists:skills,id',
    ]);

    // LOGIKA EMAIL
    $fullEmail = $request->email_username . '@student.ciputra.ac.id';
    if ($fullEmail !== $user->email && \App\Models\User::where('email', $fullEmail)->exists()) {
        return back()->withErrors(['email_username' => 'Email already taken.']);
    }

    // UPLOAD FOTO
    if ($request->hasFile('photo')) {
        if ($user->photo_url) \Illuminate\Support\Facades\Storage::disk('public')->delete($user->photo_url);
        $user->photo_url = $request->file('photo')->store('profile-photos', 'public');
    }

    // UPLOAD CV
    if ($request->hasFile('cv_file')) {
        if ($user->saved_cv_name) \Illuminate\Support\Facades\Storage::disk('public')->delete('documents/' . $user->saved_cv_name);
        $originalName = $request->file('cv_file')->getClientOriginalName();
        $request->file('cv_file')->storeAs('documents', $originalName, 'public');
        $user->saved_cv_name = $originalName;
    }

    // UPLOAD PORTFOLIO
    if ($request->hasFile('portfolio_file')) {
        if ($user->saved_portfolio_name) \Illuminate\Support\Facades\Storage::disk('public')->delete('documents/' . $user->saved_portfolio_name);
        $originalName = $request->file('portfolio_file')->getClientOriginalName();
        $request->file('portfolio_file')->storeAs('documents', $originalName, 'public');
        $user->saved_portfolio_name = $originalName;
    }

    // SIMPAN DATA TEXT
    $user->name = $request->name;
    $user->email = $fullEmail;
    $user->phone_number = $request->phone_number;
    $user->major_id = $request->major;
    $user->gpa = $request->gpa;
    $user->batch = $request->batch;
    $user->date_of_birth = $request->date_of_birth;
    $user->save();

    // 5. UPDATE SKILLS (Gunakan nama relasi baru: userSkills)
    // Ini memperbaiki error "Call to undefined method... skills()"
    $user->userSkills()->sync($request->input('skills', []));

    return back()->with('success', 'Profile & Skills updated successfully!');
}

    public function settings()
    {
        return view('user.settings');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed', // Dasar
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'current_password.current_password' => 'Password lama salah.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Cek Kriteria Tambahan (Regex) Manual agar pesan spesifik
        $validator->after(function ($validator) use ($request) {
            $password = $request->new_password;
            
            // Skip jika password kosong (biar error required aja yg muncul)
            if (!$password) return;

            $errors = [];
            if (!preg_match('/[A-Z]/', $password)) $errors[] = 'Huruf Besar';
            if (!preg_match('/[a-z]/', $password)) $errors[] = 'Huruf Kecil';
            if (!preg_match('/[0-9]/', $password)) $errors[] = 'Angka';
            if (!preg_match('/[@$!%*#?&]/', $password)) $errors[] = 'Simbol (@$!%*#?&)';

            if (!empty($errors)) {
                $validator->errors()->add('new_password', 'Kurang: ' . implode(', ', $errors) . '.');
            }
        });

        // 1. JIKA ERROR -> Kirim JSON 422
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. JIKA SUKSES -> Update DB
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah!'
        ], 200);
    }

    public function updateSettings(Request $request)
{
    $user = Auth::user();
    
    // Validasi input
    $request->validate([
        'key' => 'required|in:notify_job_alerts,notify_app_status,notify_news,is_visible_to_recruiters',
        'value' => 'required|boolean',
    ]);

    // Update dynamic berdasarkan key yang dikirim
    $user->{$request->key} = $request->value;
    $user->save();

    return response()->json(['status' => 'success', 'message' => 'Settings saved']);
}

public function deleteAccount(Request $request)
{
    $user = Auth::user();
    
    // Opsional: Hapus file foto/cv/porto dari storage sebelum hapus user
    // Storage::delete($user->photo_url); 
    
    Auth::logout();
    $user->delete();

    return redirect()->route('login')->with('success', 'Your account has been deleted.');
}
}