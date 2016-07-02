<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Task extends Model
{
    protected $fillable = [
        'task', 'description', 'done', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopePersonalize()
    {
        if (Auth::check()) {
            return self::where('user_id', Auth::user()->id);
        }
    }
}
