<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationProductModel extends Model
{
    protected $fillable = [
        'product_id',
        'quotation_id',
        'model_code',
        'code_order_id',
       
    ];

    public static $colors = [
        'primary',
        'secondary',
        'danger',
        'warning',
        'info',
        'success',
    ];
}
