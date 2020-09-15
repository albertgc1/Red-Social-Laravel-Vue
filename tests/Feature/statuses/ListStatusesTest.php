<?php

namespace Tests\Feature;

use App\Status;
use App\User;
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

    /** @test */
    public function can_get_statuses_for_a_specific_user()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        factory(Status::class)->create(['user_id' => $user->id, 'created_at' => now()->subDay()]);
        $status1 = factory(Status::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson(route('users.statuses.index', $user));

        $response->assertJson([
            'meta' => ['total' => 2]
        ]);

        $response->assertJsonStructure([
            'data', 'links' => ['prev', 'next']
        ]);

        $this->assertEquals($status1->id, $response->json('data.0.id'));
    }
}
