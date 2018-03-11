<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        'event',
        'learned',
        'well',
        'better',
        'implications'
    ];

}
