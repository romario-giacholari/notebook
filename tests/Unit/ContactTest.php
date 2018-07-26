<?php

namespace Tests\Unit;

use App\User;
use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_contact_can_make_a_string_path()
    {
        $contact = create(Contact::class);

        $this->assertEquals($contact->path(), "/contacts/{$contact->id}");
    }

    public function test_a_contact_belongs_to_a_user()
    {
        $this->actingAs($user = create(User::class));

        $contact = make(Contact::class);

        $user->contacts()->save($contact);

        $this->assertTrue($user->contacts->contains($contact)); 
    }
}
