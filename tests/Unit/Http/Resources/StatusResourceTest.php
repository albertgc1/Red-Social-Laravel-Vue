<?php

namespace Tests\Unit\Http\Resources;

use App\Status;
use Tests\TestCase;
use App\Http\Resources\UserResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\CommentResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_status_resource_have_the_neccesary_fields()
    {
        $status = factory(Status::class)->create();

        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals($status->id, $statusResource['id']);
        $this->assertEquals($status->body, $statusResource['body']);
        $this->assertEquals($status->created_at->diffForHumans(), $statusResource['ago']);

        $this->assertEquals(
            CommentResource::class,
            $statusResource['comments']->collects
        );

        $this->assertInstanceOf(
            UserResource::class,
            $statusResource['user']
        );
    }
}
