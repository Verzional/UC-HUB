<?php

namespace App\Http\Services;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Collection;

class JobRecommendationService
{
    /**
     * Recommend jobs for a given user.
     *
     * Scores are based primarily on skill overlap between the user and each job,
     * with an optional boost from the user's survey CGPA if available.
     *
     * @return \Illuminate\Support\Collection<int, array{job: \App\Models\Job, score: float}>
     */
    public function recommendForUser(User $user, int $limit = 10): Collection
    {
        // Skills explicitly attached to the user via the user_skill pivot.
        $userSkillIds = $user->skills()->pluck('skills.id')->all();

        // Normalize CGPA to [0, 1]; fall back to a neutral value when missing.
        $userSurvey = $user->survey; // may be null
        $cgpaNormalized = $userSurvey ? min(max($userSurvey->cgpa / 4.0, 0), 1) : 0.5;

        // Eager-load skills and company for all jobs (employments).
        $jobs = Job::with(['skills', 'company'])->get();

        $scored = $jobs->map(function (Job $job) use ($userSkillIds, $cgpaNormalized) {
            $jobSkillIds = $job->skills->pluck('id')->all();

            if (empty($jobSkillIds) || empty($userSkillIds)) {
                return [
                    'job' => $job,
                    'score' => 0.0,
                ];
            }

            $matchedSkillCount = count(array_intersect($userSkillIds, $jobSkillIds));
            $skillMatchRatio = $matchedSkillCount / max(count($jobSkillIds), 1);

            // Weighted score: 70% skill match, 30% CGPA.
            $score = (0.7 * $skillMatchRatio + 0.3 * $cgpaNormalized) * 100;

            return [
                'job' => $job,
                'score' => round($score, 2),
            ];
        });

        return $scored
            ->sortByDesc('score')
            ->take($limit)
            ->values();
    }
}