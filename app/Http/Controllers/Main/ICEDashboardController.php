<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use App\Models\Skill;
use App\Models\Survey;

class ICEDashboardController extends Controller
{
    public function index()
    {
        // Semua company dari database
        $allCompanies = Company::all();

        // Top surveyed companies (sementara = all companies, backend belum ada pivot)
        $topSurveyedCompanies = Company::take(10)->get();

        // Jobs & Surveys
        $jobs = Job::latest()->take(20)->get();
        $surveys = Survey::with(['user', 'wishlists'])->get();
        $skills = Skill::all();

        return view('main.ice.dashboard', [
            'allCompanies' => $allCompanies,
            'topSurveyedCompanies' => $topSurveyedCompanies,
            'jobs' => $jobs,
            'surveys' => $surveys,
            'skills' => $skills,
        ]);
    }
}
