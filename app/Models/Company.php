<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Company extends Model
{
    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\CompanyFactory> */
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'website',
        'industry',
        'profile_photo_path',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function surveys()
    {
        return $this->belongsToMany(Survey::class, 'survey_company');
    }
}
