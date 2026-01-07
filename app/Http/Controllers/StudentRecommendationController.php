<?php

namespace App\Http\Controllers;

use App\Http\Services\StudentRecommendationService;
use App\Models\Job;
use Illuminate\Http\Request;

class StudentRecommendationController extends Controller
{
    public function __construct(
        private StudentRecommendationService $studentRecommendationService
    ) {}

    public function recommendForJob(Job $job)
    {
        $recommendations = $this->studentRecommendationService->recommendForJob($job);

        return view('main.recommendations.students', compact('job', 'recommendations'));
    }
}