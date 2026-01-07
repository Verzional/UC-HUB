<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Skill;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function create()
    {
        // Check if user already has a survey
        if (Auth::user()->survey) {
            return redirect()->route('dashboard');
        }

        $skills = Skill::all();
        $companies = Company::all();
        $industries = ['Technology', 'Finance', 'Healthcare', 'Education', 'Manufacturing', 'Retail', 'Consulting', 'Other']; // Hardcoded industries

        return view('main.surveys.create', compact('skills', 'companies', 'industries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'primary_interest' => 'required|string',
            'cgpa' => 'required|numeric|min:0|max:4',
            'skills' => 'required|array|size:5',
            'skills.*' => 'exists:skills,id',
            'companies' => 'array',
            'companies.*' => 'exists:companies,id',
        ]);

        $user = Auth::user();

        // Create survey
        $survey = Survey::create([
            'user_id' => $user->id,
            'primary_interest' => $request->primary_interest,
            'cgpa' => $request->cgpa,
        ]);

        // Attach skills to survey
        $survey->skills()->attach($request->skills);

        // Attach skills to user
        $user->skills()->syncWithoutDetaching($request->skills);

        // Attach companies to survey
        if ($request->companies) {
            $survey->companies()->attach($request->companies);
        }

        return redirect()->route('dashboard')->with('success', 'Survey completed successfully!');
    }
}