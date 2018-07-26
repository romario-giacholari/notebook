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

        $this->withoutExceptionHandling();
    }

    public function test_a_user_can_save_a_todo()
    {
        
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

    public function test_a_user_can_mark_a_todo_as_completed()
    {
        $this->actingAs($this->user);
        
        $todo = create(Todo::class, [
            'user_id' => $this->user->id,
            'body' => 'finish the todos tests',
            'completed' => false
        ]);

        $this->patch(route('todos.update', $todo), [
            'completed' => true,
            'body' => 'finish the todos'
        ]);

        $this->assertTrue((bool) $todo->fresh()->completed);
    }

    public function test_a_user_can_update_a_todo()
    {
        $this->actingAs($this->user);
        
        $todo = create(Todo::class, [
            'user_id' => $this->user->id,
            'body' => 'finish the todos tests',
        ]);

        $this->patch(route('todos.update', $todo), [
            'completed' => false,
            'body' => 'Changed'
        ]);

        $this->assertEquals('Changed', $todo->fresh()->body);
    }

    public function test_a_user_cannot_update_a_todo_they_dont_own()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->user);
        
        $todo = create(Todo::class);

        $response = $this->put(route('todos.destroy', $todo));

        $response->assertStatus(403); // unauthorized.
    }

    public function test_a_user_can_delete_a_todo()
    {
        $this->actingAs($this->user);
        
        $todo = create(Todo::class, [
            'user_id' => $this->user->id,
        ]);

        $this->delete(route('todos.destroy', $todo));

        $this->assertDatabaseMissing('todos', ['todo' => $todo] );
    }

    public function test_a_user_cannot_delete_a_todo_they_dont_own()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->user);
        
        $todo = create(Todo::class);

        $response = $this->delete(route('todos.destroy', $todo));

        $response->assertStatus(403); // unauthorized.
    }
}
