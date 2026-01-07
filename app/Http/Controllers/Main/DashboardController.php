<?php

namespace App\Http\Controllers\ICE;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display ICE dashboard
     */
    public function index()
    {
        // Untuk sekarang ambil data real dari database
        // Kalau nanti mau dummy, tinggal comment bagian ini

        $totalCompanies = Company::count();
        $totalJobs = Job::count();

        // Company terbaru (untuk card list)
        $companies = Company::latest()
            ->take(9)
            ->get();

        return view('main.ice.dashboard', [
            'totalCompanies' => $totalCompanies,
            'totalJobs' => $totalJobs,
            'companies' => $companies,
        ]);
    }
}
