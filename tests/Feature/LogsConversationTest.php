<?php

namespace Tests\Feature;

use App\User;
use App\Contact;
use Tests\TestCase;
use App\Conversation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogsConversationTest extends TestCase
{
 
    use RefreshDatabase;

    protected $user;
    protected $contact;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
        
        $this->contact = create(Contact::class);

        $this->withoutExceptionHandling();
    }

    public function test_a_contact_can_log_a_conversation()
    {
        $conversation = make(Conversation::class);

        $this->contact->conversations()->save($conversation);
        
        $this->assertTrue($this->contact->conversations->contains($conversation));
    }

    public function test_a_contact_can_create_a_converstation()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('contacts.conversations.store', $this->contact), [
           'topic' => 'About the podcast',
           'body' => 'Bla bla bla ...',
        ]);

        $this->assertCount(1, $this->contact->conversations);
    }

    public function test_a_contact_can_update_a_converstation()
    {
        $this->actingAs($this->user);

        $conversation = create(Conversation::class, [
            'contact_id' => $this->contact->id
        ]);

        $this->put(route('contacts.conversations.update',[ $this->contact,  $conversation]), [
           'topic' => 'Other topic',
           'body' => 'Bla bla bla ...',
        ]);
        
        $this->assertEquals('Other topic', $conversation->fresh()->topic);
    }

    public function test_a_contact_can_delete_a_converstation()
    {
        $this->withExceptionHandling();
        
        $this->actingAs($this->user);

        $conversation = create(Conversation::class, [
            'contact_id' => $this->contact->id
        ]);
        
        $this->delete(route('contacts.conversations.destroy',[ $this->contact,  $conversation]));
        
        $this->assertCount(0, $this->contact->conversations);
    }
}
