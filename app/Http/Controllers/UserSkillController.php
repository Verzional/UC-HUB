<?php

namespace App\Http\Controllers;

use App\Models\UserSkill;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userSkills = UserSkill::with('user', 'skill')->get();

        return view('main.user-skills.index', compact('userSkills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $skills = Skill::all();

        return view('main.user-skills.create', compact('users', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'skill_id' => 'required|exists:skills,id',
        ]);

        // Check if already exists
        if (UserSkill::where('user_id', $request->user_id)->where('skill_id', $request->skill_id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'This user skill combination already exists.']);
        }

        UserSkill::create($request->only(['user_id', 'skill_id']));

        return redirect()->route('user-skills.index')->with('success', 'User skill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSkill $userSkill)
    {
        $userSkill->load('user', 'skill');

        return view('main.user-skills.show', compact('userSkill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserSkill $userSkill)
    {
        $users = User::all();
        $skills = Skill::all();

        return view('main.user-skills.edit', compact('userSkill', 'users', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserSkill $userSkill)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'skill_id' => 'required|exists:skills,id',
        ]);

        // Check if another exists
        if (UserSkill::where('user_id', $request->user_id)->where('skill_id', $request->skill_id)->where('id', '!=', $userSkill->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'This user skill combination already exists.']);
        }

        $userSkill->update($request->only(['user_id', 'skill_id']));

        return redirect()->route('user-skills.index')->with('success', 'User skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSkill $userSkill)
    {
        $userSkill->delete();

        return redirect()->route('user-skills.index')->with('success', 'User skill deleted successfully.');
    }
}
