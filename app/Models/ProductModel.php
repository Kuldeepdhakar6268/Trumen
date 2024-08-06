<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $fillable = [
        'name',
      
    ];
     public function category()
    {
        return $this->hasOne('App\Models\Group', 'id', 'group_id')->first();
    }

    
}
