<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employments = Employment::with('company')->get();

        return view('main.employments.index', compact('employments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();

        return view('main.employments.create', compact('companies'));
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

        Employment::create($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employment $employment)
    {
        $employment->load('company');

        return view('main.employments.show', compact('employment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employment $employment)
    {
        $companies = Company::all();

        return view('main.employments.edit', compact('employment', 'companies'));
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

        $employment->update($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employment $employment)
    {
        $employment->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
