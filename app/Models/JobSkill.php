<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\JobSkillFactory> */
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'job_id',
        'skill_id',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
