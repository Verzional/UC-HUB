<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Ubah kolom JSON di database menjadi Array PHP otomatis
    protected $casts = [
        'category_ids' => 'array',
        'responsibilities' => 'array',
        'qualifications' => 'array',
        'benefits' => 'array',
    ];

    // RELASI KE COMPANY
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // RELASI KE FAVORITES (User)
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'job_id', 'user_id')
                    ->withPivot('is_favorite')
                    ->withTimestamps();
    }

    // --- TAMBAHAN BARU: RELASI SKILLS ---
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills', 'job_id', 'skill_id');
    }
}