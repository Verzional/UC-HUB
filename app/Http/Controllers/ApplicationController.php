<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with('user', 'job')->get();
        
        return view('main.applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $jobs = Job::all();

        return view('main.applications.create', compact('users', 'jobs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_id' => 'required|exists:jobs,id',
            'cover_letter' => 'nullable|string',
            'resume_path' => 'nullable|string',
            'portfolio_path' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        Application::create($request->all());

        return redirect()->route('applications.index')->with('success', 'Application created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $application->load('user', 'job');

        return view('main.applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        $users = User::all();
        $jobs = Job::all();

        return view('main.applications.edit', compact('application', 'users', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_id' => 'required|exists:jobs,id',
            'cover_letter' => 'nullable|string',
            'resume_path' => 'nullable|string',
            'portfolio_path' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $application->update($request->all());

        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }
}
