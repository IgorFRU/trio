<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'question',
        'name',
        'email',
        'notify',
        'ip',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setIpAttribute($value) {
        $this->attributes['ip'] = $_SERVER['REMOTE_ADDR'];
    }

    public function setUserIdAttribute($value) {
        $this->attributes['user_id'] = (Auth::check()) ? Auth::id() : 0 ;        
    }

    public function getCreatedAttribute() {
        return $this->created_at->locale('ru')->isoFormat('DD MMMM YYYY', 'Do MMMM');
    }

    public function scopePublished($query) {
        return $query->where('published', 1);
    }
}
