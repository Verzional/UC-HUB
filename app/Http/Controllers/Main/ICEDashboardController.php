<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;

class ICEDashboardController extends Controller
{
    public function index()
    {
        $totalCompanies = Company::count();
        $totalJobs = Job::count();
        $companies = Company::latest()->take(9)->get();

        return view('main.ice.dashboard', compact('totalCompanies', 'totalJobs', 'companies'));
    }
}
