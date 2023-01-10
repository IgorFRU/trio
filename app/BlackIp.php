<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackIp extends Model
{
    protected $fillable = [
        'ip',
        'start_ip',
        'stop_ip',
    ];
}
