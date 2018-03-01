<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name'
    ];
    
    public function path()
    {
        return "/contacts/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
