<?php

namespace Tests\Feature;

use App\Todo;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodosTest extends TestCase
{
 
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    public function test_a_user_can_save_a_todo()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);
        
        $todo = make(Todo::class, [
            'body' => 'finish the todos tests'
        ]);
        
        $notMyTodo = create(Todo::class);

        $this->user->todos()->save($todo);

        $this->get('/todos')
            ->assertSee($todo->body)
            ->assertDontsee($notMyTodo->body);
    }
}
