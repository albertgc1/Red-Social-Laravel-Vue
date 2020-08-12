<?php

namespace Tests\Unit;

use App\User;
use App\Status;
use App\Comment;
use Tests\TestCase;
use App\Traits\HasLikes;
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
    public function a_status_has_many_comments()
    {
    	$status = factory(Status::class)->create();

    	factory(Comment::class)->create(['status_id' => $status->id]);

    	$this->assertInstanceOf(Comment::class, $status->comments->first());
    }

    /** @test */
    public function a_status_model_must_use_the_trait_has_likes()
    {
        $uses = class_uses(Status::class);

        $this->assertArrayHasKey(HasLikes::class, $uses);
    }
}
