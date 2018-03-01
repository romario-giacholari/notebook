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

    public function test_an_authenticated_user_can_save_a_contact()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

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
        
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $contact = factory(Contact::class)->create([
            'user_id' => $user->id,
            'name' => 'Michael'
        ]);

        $this->put(route('contacts.update', $contact->id), ['name' => 'John']);

        $this->assertEquals('John', $contact->fresh()->name);
    }

    public function test_an_authenticated_user_can_delete_a_contact()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $contact = factory(Contact::class)->create([
            'user_id' => $user->id,
        ]);

        $this->delete(route('contacts.destroy', $contact->id));

        $this->assertCount(0, $user->contacts);
    }

}
