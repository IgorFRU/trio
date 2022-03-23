<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'site_name',
        'address',
        'phone_1',
        'phone_2',
        'email',
        'viber',
        'whatsapp',
        'vkontakte',
        'main_text',
        'orderstatus_id',
        'time_to_update_tomorrow',
    ];

    public function getFullMainPhoneAttribute($value) {
        if ($this->phone_1 != NULL || $this->phone_1 != '') {
            return '+7' . $this->phone_1;
        } else {
            return '';
        }
    }

    public function getMainPhoneAttribute($value) {
        if ($this->phone_1 != NULL || $this->phone_1 != '') {
            $phone_number = substr_replace($this->phone_1, ' ', 8, 0);
            $phone_number = substr_replace($phone_number, ' ', 6, 0);
            $phone_number = substr_replace($phone_number, ') ', 3, 0);
            $phone_number = substr_replace($phone_number, ' (', 0, 0);
            return '+7' . $phone_number;
        } else {
            return '';
        }
    }
}
