<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productdifferent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'productdifferent',
    ];   

    // public function category() {
    //     return $this->belongsToMany(Category::class);
    // }

    // public function propertyvalues() {
    //     return $this->belongsToMany(Propertyvalue::class);
    // }

    // public function values() {
    //     return $this->hasMany(Propertyvalue::class);
    // }
}
