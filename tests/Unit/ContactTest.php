<?php

namespace Tests\Unit;

use App\User;
use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    public function test_it_returns_its_path()
    {
        $contact = create(Contact::class);

        $this->assertEquals("/contacts/{$contact->id}", $contact->path());
    }

    public function test_it_belongs_to_a_user()
    {
        $contact = create(Contact::class, [
            'user_id' => $this->user->id
        ]);

        $this->assertEquals($this->user->name, $contact->user->name);
    }

    public function test_an_authenticated_user_can_save_a_contact()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($this->user);

        $this->post(route('contacts.store'), ['name' => 'James']);

        $this->assertDatabaseHas('contacts', ['name' => 'James']);
    }

    public function test_an_anauthenticated_user_cannot_save_a_contact()
    {
        $response = $this->post(route('contacts.store'), ['name' => 'James']);

        $response->assertRedirect('/login'); 
    }

    public function test_an_authenticated_user_can_update_a_contact()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($this->user);

        $contact = create(Contact::class, [
            'user_id' => $this->user->id,
            'name' => 'Michael'
        ]);

        $this->put(route('contacts.update', $contact->id), ['name' => 'John']);

        $this->assertEquals('John', $contact->fresh()->name);
    }

    public function test_an_authenticated_user_can_delete_a_contact()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($this->user);

        $contact = factory(Contact::class)->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertCount(1, $this->user->contacts);

        $this->delete(route('contacts.destroy', $contact->id));

        $this->assertCount(0, $this->user->fresh()->contacts);
    }

}
