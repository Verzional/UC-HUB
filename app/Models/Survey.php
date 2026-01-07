<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'user_id',
        'primary_interest',
        'cgpa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'survey_skill');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
