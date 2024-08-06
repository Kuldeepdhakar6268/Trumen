<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermVariation extends Model
{
    protected $fillable = [
        'term_id',
        'details',
        'created_by',
    ];

    
}
