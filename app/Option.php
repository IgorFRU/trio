<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'option',
    ];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function choises() {
        return $this->belongsToMany(Choise::class);
    }
}
