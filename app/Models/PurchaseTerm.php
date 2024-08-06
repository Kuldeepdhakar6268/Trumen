<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTerm extends Model
{
    protected $fillable = [
        'purchase_id',
        'terms_type',
        'price',
        'p_f',
        'p_f_next',
        'taxes',
        'freight',
        'insurance',
        'transaction',
        'delivery',
        'payment',
        'edited_payment',
        'warranty',
        'validity_offer',
        'release_po',
        'cancellation_charges',
        
        
    ];

    public function purchase(){
        return $this->hasOne('App\Models\Purchase', 'id', 'purchase_id')->first();
    }
}
