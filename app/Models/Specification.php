<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    
   
    protected $fillable = [
        'name',
        'price',
        'priority',
        'sku',
        'image',
        'group_id',
        'product_model_id',
        'created_by',
    ];

    public $customField;
    
    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
    public function model()
    {
        return $this->hasOne('App\Models\ProductModel', 'id', 'product_model_id');
    }
    public function category()
    {
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }
    public function subspecifications()
    {
        return $this->hasMany('App\Models\Specification', 'priority');
    }
}
