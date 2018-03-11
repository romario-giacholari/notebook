<?php

namespace Tests\Feature;

use App\User;
use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FetchesContactsTest extends TestCase
{
 
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    public function test_it_fetches_a_specific_contact()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($this->user);
        
        $contact = make(Contact::class, [
            'name'=> 'JohnDoe'
        ]);

        $this->user->contacts()->save($contact);

        $response = $this->get($contact->path());

        $response->assertSee('JohnDoe');
    }

    
    public function test_it_fetches_all_contacts()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($this->user);

        $John = create(Contact::class, [
            'user_id' => $this->user->id
        ]);

        $Emma = create(Contact::class, [
            'user_id' => $this->user->id
        ]);

        $response = $this->get('/contacts');

        $response->assertSee($John->name);
        $response->assertSee($Emma->name);
    }
}
