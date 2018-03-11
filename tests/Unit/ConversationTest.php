<?php

namespace Tests\Unit;

use App\User;
use App\Contact;
use Tests\TestCase;
use App\Conversation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConversationTest extends TestCase
{
    use RefreshDatabase;
    
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    public function test_a_conversation_belongs_to_a_contact()
    {
        $contact = create(Contact::class);

        $conversation = create(Conversation::class, [
            'contact_id' => $contact->id
        ]);

        $this->assertEquals($contact->name, $conversation->contact->name);
    }

}
