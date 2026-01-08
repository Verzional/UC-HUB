<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $guarded = ['id'];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}