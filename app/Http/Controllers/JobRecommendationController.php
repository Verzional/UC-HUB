<?php

namespace App\Http\Controllers;

use App\Http\Services\JobRecommendationService;

class JobRecommendationController extends Controller
{
    public function __construct(
        private JobRecommendationService $jobRecommendationService
    ) {}

    public function recommendForUser()
    {
        $user = auth()->user();
        $recommendations = $this->jobRecommendationService->recommendForUser($user);

        return view('main.recommendations.jobs', compact('user', 'recommendations'));
    }
}
