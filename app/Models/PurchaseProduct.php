<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $fillable = [
        'product_id',
        'purchase_id',
        'quantity',
        'tax',
        'discount',
        'total',
    ];

    public function product()
    {
        return $this->hasOne('App\Models\ProductService', 'id', 'product_id');
    }
    // public function material()
    // {
    //     return $this->hasOne('App\Models\OrderRequest', 'id', 'product_id');
    // }
    public function orderRequest()
    {
        return $this->hasOne('App\Models\OrderRequest', 'id', 'product_id');
    }
}
