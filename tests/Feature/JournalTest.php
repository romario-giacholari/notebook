<?php

namespace Tests\Feature;

use App\User;
use App\Journal;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JournalTest extends TestCase 
{

    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);

        $this->withoutExceptionHandling();
    }

    public function test_a_user_can_save_a_new_journal_entry()
    {
        $this->actingAs($this->user);

        $notMyJournal = create(Journal::class, [
            'event' => 'Presentation',
        ]);

        $journal = make(Journal::class, [
            'event' => 'Attended first ever seminar',
            'learned' => 'I know nothing',
            'well' => 'I did well ...',
            'better' => 'Grab a pen next time',
            'implications' => 'none'
        ]);

        $this->user->journals()->save($journal);

        $this->get('/journals')
            ->assertSee($journal->event)
            ->assertDontSee($notMyJournal->event);
    }

    public function test_a_user_can_create_a_new_journal_entry()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('journals.store'), [
            'event' => 'Attended first ever seminar',
            'learned' => 'I know nothing',
            'well' => 'I did well ..',
            'better' => 'Grab a pen next time',
            'implications' => 'none'
        ]);

        $this->assertCount(1, $this->user->journals);

    }

    public function test_a_user_can_update_an_existing_journal_entry()
    {
        $this->actingAs($this->user);

        $journal = create(Journal::class, [
            'user_id' => $this->user->id
        ]);

        $this->put(route('journals.update', $journal), [
            'event' => 'Went to the meeting',
            'learned' => 'I know nothing',
            'well' => 'I did well ...',
            'better' => 'Grab a pen next time',
            'implications' => 'none'
        ]);

        $this->assertEquals('Went to the meeting', $journal->fresh()->event);
    }

    public function test_a_user_cannot_update_a_journal_entry_that_they_dont_own()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->user);
        
        $journal = create(Journal::class);

        $response = $this->put(route('journals.destroy', $journal));

        $response->assertStatus(403); // unauthorized.
    }

    
    public function test_a_user_can_delete_an_existing_journal_entry()
    {
        $this->actingAs($this->user);

        $journal = create(Journal::class, [
            'user_id' => $this->user->id
        ]);

        $this->delete(route('journals.destroy', $journal));

        $this->assertDatabaseMissing('journals', ['journal' => $journal]);
    }

    public function test_a_user_cannot_delete_a_journal_entry_that_they_dont_own()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->user);
        
        $journal = create(Journal::class);

        $response = $this->delete(route('journals.destroy', $journal));

        $response->assertStatus(403); // unauthorized.
    }
}