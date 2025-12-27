<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
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

        return view('main.jobs.create', compact('companies'));
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
            'salary' => 'nullable|numeric',
            'application_deadline' => 'nullable|date',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
        ]);

        Job::create($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load('company');

        return view('main.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $companies = Company::all();
        
        return view('main.jobs.edit', compact('job', 'companies'));
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
            'salary' => 'nullable|numeric',
            'application_deadline' => 'nullable|date',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
        ]);

        $job->update($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
