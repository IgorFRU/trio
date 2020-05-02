<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choisevalue extends Model
{
    protected $fillable = [
        'value',
        'scu',
        'choise_id',
        'product_id',
        'color',
        'thumbnail',
        'image',
        'price',
        'price_type',
        'discount_id',
    ];

    public function choises() {
        return $this->belongsTo(Choise::class, 'choise_id', 'id');
    }

    public function products() {
        return $this->belongsTo(Product::class);
    }
}
