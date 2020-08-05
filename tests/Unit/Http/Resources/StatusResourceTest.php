<?php

namespace Tests\Unit\Http\Resources;

use App\Like;
use App\Status;
use Tests\TestCase;
use App\Http\Resources\StatusResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_status_resource_have_the_neccesary_fields()
    {
        $status = factory(Status::class)->create();
        factory(Like::class)->create(['status_id' => $status->id]);
        factory(Like::class)->create(['status_id' => $status->id]);
        factory(Like::class)->create(['status_id' => $status->id]);

        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals($status->id, $statusResource['id']);
        $this->assertEquals($status->body, $statusResource['body']);
        $this->assertEquals($status->user->name, $statusResource['user_name']);
        $this->assertEquals('https://iupac.org/wp-content/uploads/2018/05/default-avatar.png', $statusResource['user_avatar']);
        $this->assertEquals($status->created_at->diffForHumans(), $statusResource['ago']);
        $this->assertEquals(3, $statusResource['likes']);
    }
}
