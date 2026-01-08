<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'timeline' => 'array',
        'applied_date' => 'datetime',
    ];

    // Relasi ke Job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // Relasi ke Company (PENTING: Tambahkan ini)
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}