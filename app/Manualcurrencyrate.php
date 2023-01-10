<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manualcurrencyrate extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'category_id',
        'manufacture_id',
        'currency_id',
        'rate'
    ];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function manufacture() {
        return $this->belongsTo(Manufacture::class);
    }
}
