<?php

namespace Tests\Feature\Firendships;

use App\Friendship;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestFriendschipTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_users_cannon_send_firenship_request()
    {
        $user = factory(User::class)->create();

        $this->postJson(route('friendships.store', $user))
            ->assertStatus(401);
    }

    /** @test */
    public function can_send_firendship_request()
    {
        $this->withExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        $this->actingAs($sender)->postJson(route('friendships.store', $recipient));

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);
    }

    /** @test */
    public function cannon_send_firendship_request_to_itself()
    {
        $this->withExceptionHandling();

        $sender = factory(User::class)->create();

        $this->actingAs($sender)->postJson(route('friendships.store', $sender));

        $this->assertDatabaseMissing('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $sender->id,
            'status' => 'pending'
        ]);
    }

    /** @test */
    public function guests_users_cannon_cancel_firenship_request()
    {
        $user = factory(User::class)->create();

        $this->deleteJson(route('friendships.store', $user))
            ->assertStatus(401);
    }

    /** @test */
    public function can_cancel_firendship_request()
    {
        $this->withExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id
        ]);

        $this->actingAs($sender)->deleteJson(route('friendships.destroy', $recipient));

        $this->assertDatabaseMissing('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id
        ]);
    }

    /** @test */
    public function guests_users_cannon_accept_or_nedied_firenship_request()
    {
        $user = factory(User::class)->create();

        $this->putJson(route('friendships.store', $user))
            ->assertStatus(401);
    }

    /** @test */
    public function can_accept_firendship_request()
    {
        $this->withExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();
        
        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($recipient)->putJson(route('friendships.update', $sender));

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'accepted'
        ]);
    }

    /** @test */
    public function can_denied_firendship_request()
    {
        $this->withExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();
        
        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($recipient)->putJson(route('friendships.update', [$sender, true]));

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'denied'
        ]);
    }

    /** @test */
    public function can_delete_a_firendship()
    {
        $this->withExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();
        $otherUser = factory(User::class)->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'accepted'
        ]);

        Friendship::create([
            'sender_id' => $otherUser->id,
            'recipient_id' => $sender->id,
            'status' => 'accepted'
        ]);

        $this->actingAs($sender)->deleteJson(route('friendships.destroy', $otherUser));

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id
        ]);

        $this->assertDatabaseMissing('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $otherUser->id
        ]);
    }

}