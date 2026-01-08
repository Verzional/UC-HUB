<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'Student')->get();

        return view('main.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        $user = $student;
        return view('main.users.show', compact('user'));
    }
}