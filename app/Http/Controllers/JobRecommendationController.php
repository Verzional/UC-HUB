<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Services\JobRecommendationService;

class JobRecommendationController extends Controller
{
    public function __construct(
        private JobRecommendationService $jobRecommendationService
    ) {}

    public function index()
    {
        return $this->recommendForUser();
    }

    public function recommendForUser()
    {
        $user = auth()->user();
        $recommendations = $this->jobRecommendationService->recommendForUser($user);
        $availableJobs = Job::with(['skills', 'company'])->get();

        return view('students.jobs.index', [
            'user' => $user,
            'recommendedJobs' => $recommendations,
            'availableJobs' => $availableJobs,
        ]);
    }

    public function show(Job $job)
    {
        return view('students.jobs.show', compact('job'));
    }
}
