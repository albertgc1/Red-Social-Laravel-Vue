<?php

namespace Tests\Unit;

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
}
