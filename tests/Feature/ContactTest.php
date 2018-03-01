<?php

namespace Tests\Feature;

use App\User;
use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
 
    use RefreshDatabase;

    public function test_it_fetches_a_specific_contact()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();

        $contact = factory(Contact::class)->make([
            'name'=> 'JohnDoe'
        ]);

        $user->contacts()->save($contact);

        $response = $this->get($contact->path());

        $response->assertSee('JohnDoe');
    }
}
