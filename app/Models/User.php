<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Skill;
use App\Models\Major;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        // Auth & Basic Info
        'name',
        'email',
        'password',
        
        // Profile Data
        'phone_number',
        'major',
        'batch',            // Angkatan
        'semester',
        'date_of_birth',    // Tanggal Lahir
        'photo_url',

        'gpa',      // Add this
        'interest', // Add this
        'skills',   // Add this
        'wishlist', // Add this
        
        // Documents
        'saved_cv_name',
        'saved_portfolio_name',
        
        // Settings (Preferences)
        'notify_job_alerts',
        'notify_app_status',
        'notify_news',
        'is_visible_to_recruiters',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date', // Otomatis jadi Carbon Instance (bisa $user->date_of_birth->format('d M Y'))
        
        // Boolean Casting (Penting untuk Toggle Switch di Settings)
        'notify_job_alerts' => 'boolean',
        'notify_app_status' => 'boolean',
        'notify_news' => 'boolean',
        'is_visible_to_recruiters' => 'boolean',
    ];

    /**
     * RELASI 1: User menyukai banyak Job (Favorites)
     * Menggunakan tabel pivot 'favorites'
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'favorites', 'user_id', 'job_id')
                    ->withTimestamps()
                    ->withPivot('is_favorite'); 
    }

    /**
     * RELASI 2: User memiliki banyak Lamaran (Applications)
     * Relasi One to Many ke tabel 'applications'
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'user_id');
    }

   public function userSkills() // Ganti nama biar gak bentrok sama kolom 'skills'
{
    return $this->belongsToMany(Skill::class, 'skill_user');
}

public function major()
{
    // Ini menghubungkan major_id di tabel users ke id di tabel majors
    return $this->belongsTo(Major::class, 'major_id');
}

}