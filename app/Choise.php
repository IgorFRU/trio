<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choise extends Model
{
    protected $fillable = [
        'choise',
        'type',
    ];

    public function options() {
        return $this->belongsToMany(Option::class);
    }

    public function values() {
        return $this->hasMany(Choisevalue::class);
    }

    // public function children() {
    //     return $this->belongsToMany(Choise::class, 'choise_choise', 'choise_parent_id', 'choise_child_id');
    // }

    // public function parents() {
    //     return $this->belongsToMany(Choise::class, 'choise_choise', 'choise_child_id', 'choise_parent_id');       
    // }

    public function scopeChildren($query)
    {
        return $query->where('type', 'child');
    }

    public function scopeParent($query)
    {
        return $query->where('type', 'parent');
    }

    public function getTypeAttribute() {
        if ($this->attributes['type'] == 'parent') {
            return 'Родит.';
        } elseif ($this->attributes['type'] == 'child') {
            return 'Дочерний';
        }        
    }
}
