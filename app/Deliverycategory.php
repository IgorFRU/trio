<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverycategory extends Model
{
    protected $fillable =   [
        'deliverycategory',
        'description',
        
    ];

    public function deliveries() {
        return $this->hasMany(Delivery::class);
    }
}
