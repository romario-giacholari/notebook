<?php

namespace Tests\Unit;

use App\User;
use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_returns_its_path()
    {
        $contact = factory(Contact::class)->create();

        $this->assertEquals("/contacts/{$contact->id}", $contact->path());
    }

    public function test_it_belongs_to_a_user()
    {
        $user = factory(User::class)->create();
        
        $contact = factory(Contact::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertEquals($user->name, $contact->user->name);
    }
}
