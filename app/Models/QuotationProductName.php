<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationProductName extends Model
{
    protected $table = 'quotation_product_names';
    protected $fillable = [
        'name',
        'created_by',
    ];

    
}
