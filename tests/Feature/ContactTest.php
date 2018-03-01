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

        $this->actingAs($user);
        
        $contact = factory(Contact::class)->make([
            'name'=> 'JohnDoe'
        ]);

        $user->contacts()->save($contact);

        $response = $this->get($contact->path());

        $response->assertSee('JohnDoe');
    }

    
    public function test_it_fetches_all_contacts()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $contacts = factory(Contact::class, 5)->create();

        $response = $this->get('/contacts');

        $json = (array) json_decode($response->getContent());

        $this->assertCount(5, $json['data']);

    }
}
