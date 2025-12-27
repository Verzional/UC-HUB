<?php

namespace App\Http\Controllers;

use App\Models\JobSkill;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;

class JobSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobSkills = JobSkill::with('job', 'skill')->get();

        return view('main.job-skills.index', compact('jobSkills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobs = Job::all();
        $skills = Skill::all();

        return view('main.job-skills.create', compact('jobs', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'skill_id' => 'required|exists:skills,id',
        ]);

        // Check if already exists
        if (JobSkill::where('job_id', $request->job_id)->where('skill_id', $request->skill_id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'This job skill combination already exists.']);
        }

        JobSkill::create($request->only(['job_id', 'skill_id']));

        return redirect()->route('job-skills.index')->with('success', 'Job skill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobSkill $jobSkill)
    {
        $jobSkill->load('job', 'skill');

        return view('main.job-skills.show', compact('jobSkill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobSkill $jobSkill)
    {
        $jobs = Job::all();
        $skills = Skill::all();

        return view('main.job-skills.edit', compact('jobSkill', 'jobs', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobSkill $jobSkill)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'skill_id' => 'required|exists:skills,id',
        ]);

        // Check if another exists
        if (JobSkill::where('job_id', $request->job_id)->where('skill_id', $request->skill_id)->where('id', '!=', $jobSkill->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'This job skill combination already exists.']);
        }

        $jobSkill->update($request->only(['job_id', 'skill_id']));

        return redirect()->route('job-skills.index')->with('success', 'Job skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobSkill $jobSkill)
    {
        $jobSkill->delete();

        return redirect()->route('job-skills.index')->with('success', 'Job skill deleted successfully.');
    }
}
