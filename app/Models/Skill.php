<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Skill extends Model
{
    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\SkillFactory> */
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'industry'];

    public function jobs()
    {
        return $this->belongsToMany(
            Job::class,
            'employment_skill',
            'skill_id',
            'employment_id',
        );
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skill');
    }

    public function surveys()
    {
        return $this->belongsToMany(Survey::class, 'survey_skill');
    }
}
