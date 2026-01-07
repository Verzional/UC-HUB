<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Models\Skill;
use App\Models\Survey;
use App\Models\Wishlist;
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

        return view('main.surveys.create', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'primary_interest' => 'required|string',
            'cgpa' => 'required|numeric|min:0|max:4',
            'skills' => 'required|array|min:1|max:5',
            'skills.*' => 'exists:skills,id',
            'wishlists' => 'array',
            'wishlists.*' => 'string|max:255',
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
        /** @var User $user */
        $user = Auth::user();

        $user->skills()->syncWithoutDetaching($request->skills);

        // Create wishlists
        if ($request->wishlists) {
            foreach ($request->wishlists as $companyName) {
                if (!empty($companyName)) {
                    Wishlist::create([
                        'survey_id' => $survey->id,
                        'company_name' => $companyName,
                    ]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Survey completed successfully!');
    }
}
