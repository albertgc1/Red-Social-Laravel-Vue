<?php

namespace Tests\Unit;

use App\Like;
use App\User;
use App\Status;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusModelTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_status_belongs_to_user()
    {
    	$status = factory(Status::class)->create();

    	$this->assertInstanceOf(User::class, $status->user);
    }

    /** @test */
    public function a_status_has_many_likes()
    {
    	$status = factory(Status::class)->create();

    	factory(Like::class)->create(['status_id' => $status->id]);

    	$this->assertInstanceOf(Like::class, $status->likes->first());
    }

    /** @test */
    public function user_can_like_and_unlike_statuses()
    {
        $this->withoutExceptionHandling();

        $status = factory(Status::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $status->like();

        $this->assertDatabaseHas('likes', [
            'status_id' => $status->id,
            'user_id' => $user->id
        ]);

        $status->unLike();

        $this->assertDatabaseMissing('likes', [
            'status_id' => $status->id,
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function status_knows_it_was_liked()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        $this->actingAs($user);

        $this->assertEquals(false, $status->isLiked());

        $status->like();

        $this->assertEquals(true, $status->fresh()->isLiked());

        $status->unLike();

        $this->assertEquals(false, $status->fresh()->isLiked());
    }

    /** @test */
    public function status_knows_how_many_likes_have()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        $this->actingAs($user);

        $this->assertEquals(0, $status->likesCount());

        $status->like();

        $this->assertEquals(1, $status->fresh()->likesCount());

        $status->unLike();

        $this->assertEquals(0, $status->fresh()->likesCount());
    }
}
