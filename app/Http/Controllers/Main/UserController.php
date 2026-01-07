<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'student_id' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'cohort_year' => 'nullable|integer',
            'major' => 'nullable|string|max:255',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portfolio_path' => 'nullable|string|max:255',
            'role' => 'required|string|in:student,ice,admin',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'student_id' => $request->student_id,
            'phone_number' => $request->phone_number,
            'cohort_year' => $request->cohort_year,
            'major' => $request->major,
            'portfolio_path' => $request->portfolio_path,
            'role' => $request->role,
        ];

        if ($request->hasFile('profile_photo_path')) {
            $data['profile_photo_path'] = $request->file('profile_photo_path')->store('profiles', 'public');
        }

        if ($request->hasFile('cv_path')) {
            $data['cv_path'] = $request->file('cv_path')->store('cvs', 'public');
        }

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'student_id' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'cohort_year' => 'nullable|integer',
            'major' => 'nullable|string|max:255',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portfolio_path' => 'nullable|string|max:255',
            'role' => 'required|string|in:student,ice,admin',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'phone_number' => $request->phone_number,
            'cohort_year' => $request->cohort_year,
            'major' => $request->major,
            'portfolio_path' => $request->portfolio_path,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile_photo_path')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $data['profile_photo_path'] = $request->file('profile_photo_path')->store('profiles', 'public');
        }

        if ($request->hasFile('cv_path')) {
            if ($user->cv_path) {
                Storage::disk('public')->delete($user->cv_path);
            }
            $data['cv_path'] = $request->file('cv_path')->store('cvs', 'public');
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
