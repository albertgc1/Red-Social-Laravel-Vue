<?php

namespace Tests\Unit;

use App\User;
use App\Friendship;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FriendshipModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function freindship_sender_belong_to_user()
    {
        $sender = factory(User::class)->create();

        $friendship = factory(Friendship::class)->create(['sender_id' => $sender->id]);

        $this->assertInstanceOf(User::class, $friendship->sender);
    }

    /** @test */
    public function freindship_recipient_belong_to_user()
    {
        $recipient = factory(User::class)->create();

        $friendship = factory(Friendship::class)->create(['recipient_id' => $recipient->id]);

        $this->assertInstanceOf(User::class, $friendship->recipient);
    }
}
