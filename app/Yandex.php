<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yandex extends Model
{
    protected $casts = [
        'category_ids' => 'array',
        'manufacture_ids' => 'array',
    ];
}
