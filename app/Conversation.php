<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'topic',
        'body'
    ];
    
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
