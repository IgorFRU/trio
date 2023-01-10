<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable =   [
        'summ_start',
        'summ_end',
        'mass_start',
        'mass_end',
        'price',
        'description',
        'priority',
        'deliverycategory_id',
    ];

    public function category() {
        return $this->belongsTo(Deliverycategory::class);
    }
}
