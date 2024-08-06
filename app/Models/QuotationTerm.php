<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationTerm extends Model
{
    protected $fillable = [
        'terms_options',
        'terms_price',
        'p_f',
        'taxes',
        'freight',
        'transit_insurance',
        'transaction',
        'delivery',
        'payment',
        'warranty',
        'validity',
        'release_po',
        'cancellation'
    ];

    public function quotation(){
        return $this->hasOne('App\Models\Quotation', 'id', 'quotation_id')->first();
    }
}
