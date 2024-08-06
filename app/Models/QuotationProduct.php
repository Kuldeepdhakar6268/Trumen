<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'tax',
        'discount',
        'price',
    ];

    public function product(){
        return $this->hasOne('App\Models\ProductService', 'id', 'product_id')->first();
    }
    public function models(){
        return $this->hasOne('App\Models\ProductModel', 'id', 'product_model_id')->first();
    }
   
}
