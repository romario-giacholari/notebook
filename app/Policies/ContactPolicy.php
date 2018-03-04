<?php

namespace App\Policies;

use App\User;
use App\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Contact $contact)
    {
       return  $user->id == $contact->user_id;
    }
}
