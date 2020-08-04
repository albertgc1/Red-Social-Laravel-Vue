<?php

namespace Tests\Unit;

use App\Like;
use App\User;
use App\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
}
