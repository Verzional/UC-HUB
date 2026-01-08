<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::with('company')->get();

        return view('main.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $skills = Skill::all();

        return view('main.jobs.create', compact('companies', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
            'employment_type' => 'nullable|string',
            'salary' => 'nullable|string',
            'application_deadline' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $job = Job::create($request->all());

        if ($request->has('skills')) {
            $job->skills()->attach($request->skills);
        }

        return redirect()
            ->route('main.ice.dashboard')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load(['company', 'skills']);

        return view('main.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $companies = Company::all();
        $skills = Skill::all();

        return view('main.jobs.edit', compact('job', 'companies', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
            'employment_type' => 'nullable|string',
            'salary' => 'nullable|string',
            'application_deadline' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $job->update($request->all());

        $job->skills()->sync($request->skills ?? []);

        return redirect()
            ->route('main.ice.dashboard')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()
            ->route('main.ice.dashboard')
            ->with('success', 'Job deleted successfully.');
    }
}
