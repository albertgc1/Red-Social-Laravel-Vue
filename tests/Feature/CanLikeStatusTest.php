<?php

namespace Tests\Feature;

use App\User;
use App\Status;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanLikeStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guess_users_cannon_like_to_statuses()
    {
        $status = factory(Status::class)->create();

        $response = $this->post(route('statuses.likes.store', $status));

        $response->assertRedirect('login');
    }

    /** @test */
    public function users_can_like_to_statuses()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        $this->actingAs($user)->postJson(route('statuses.likes.store', $status));

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id
        ]);
    }

    /** @test */
    public function users_can_like_to_statuses_once()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        $this->actingAs($user)->postJson(route('statuses.likes.store', $status));

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id
        ]);

        $this->actingAs($user)->postJson(route('statuses.likes.store', $status));

        $this->assertEquals(1, $status->likes->count());
    }
}
