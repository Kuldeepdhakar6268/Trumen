<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationProductDesc extends Model
{
    protected $table = 'quotation_product_descriptions';
    protected $fillable = [
        'name',
        'created_by',
    ];

    
}
