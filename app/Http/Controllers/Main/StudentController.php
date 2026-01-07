<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::where('role', 'student')->paginate(10);

        return view('main.students.index', compact('students'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Ensure the user is a student
        if ($user->role !== 'student') {
            abort(404);
        }

        return view('main.students.show', compact('user'));
    }
}
