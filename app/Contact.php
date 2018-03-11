<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'gender',
        'phone_number'
    ];

    protected $appends = ['path'];
    
    public function path()
    {
        return "/contacts/{$this->id}";
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
