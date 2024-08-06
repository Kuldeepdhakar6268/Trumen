<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialStock extends Model
{
    protected $fillable = [
        'material_code',
        'material_name',
        'purchased_qty',
        'used_qty',
        'dead_material_qty',
        'unit_price',
        'current_qty',
        'stock_value',
        'created_by',
    ];

    public $customField;
}
