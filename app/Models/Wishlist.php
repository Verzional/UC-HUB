<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'survey_id',
        'company_name',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
