<?php

namespace Tests\Feature;

use App\Status;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListStatusesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_statuses()
    {
        $this->withoutExceptionHandling();

        factory(Status::class)->create(['created_at' => now()->subDays(3)]);
        factory(Status::class)->create(['created_at' => now()->subDays(2)]);
        $status = factory(Status::class)->create(['created_at' => now()->subDays(1)]);

        $response = $this->getJson(route('status.index'));

        $response->assertStatus(200);

        $response->assertJson([
            'meta' => ['total' => 3]
        ]);

        $response->assertJsonStructure([
            'data', 'meta'
        ]);

        $this->assertEquals($status->id, $response->json('data.0.id'));
    }
}
