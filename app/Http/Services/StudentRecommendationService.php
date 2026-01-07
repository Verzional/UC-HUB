<?php

namespace App\Http\Services;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Collection;

class StudentRecommendationService
{
    /**
     * Recommend students for a given job (employment).
     *
     * Scores are based primarily on skill overlap between the job and each user,
     * with an optional boost from the user's survey CGPA if available.
     *
     * @return \Illuminate\Support\Collection<int, array{user: \App\Models\User, score: float}>
     */
    public function recommendForJob(Job $job, int $limit = 10): Collection
    {
        // Skills explicitly attached to the job via the employment_skill pivot.
        $jobSkillIds = $job->skills()->pluck('skills.id')->all();

        // Limit candidates to users in a student-like role; support both cases used in the codebase.
        $students = User::query()
            ->where('role', 'student')
            ->with(['skills', 'survey'])
            ->get();

        $scored = $students->map(function (User $user) use ($jobSkillIds) {
            $userSkillIds = $user->skills->pluck('id')->all();

            if (empty($jobSkillIds) || empty($userSkillIds)) {
                return [
                    'user' => $user,
                    'score' => 0.0,
                ];
            }

            $matchedSkillCount = count(array_intersect($jobSkillIds, $userSkillIds));
            $skillMatchRatio = $matchedSkillCount / max(count($jobSkillIds), 1);

            $survey = $user->survey; // may be null
            $cgpaNormalized = $survey ? min(max($survey->cgpa / 4.0, 0), 1) : 0.5;

            // Weighted score: 70% skill match, 30% CGPA.
            $score = (0.7 * $skillMatchRatio + 0.3 * $cgpaNormalized) * 100;

            return [
                'user' => $user,
                'score' => round($score, 2),
            ];
        });

        return $scored
            ->sortByDesc('score')
            ->take($limit)
            ->values();
    }
}