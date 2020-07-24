<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_users_cannon_create_statuses()
    {
        $response = $this->post(route('status.store', ['body' => 'mi primer status']));

        $response->assertRedirect('login');
    }

    /** @test */
    public function testExample()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('status.store', ['body' => 'mi primer status']));

        $response->assertJson([
            'body' => 'mi primer status'
        ]);

        $this->assertDatabaseHas('statuses', [
            'body' => 'mi primer status',
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function a_status_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('status.store', ['body' => '']));

        $response->assertJsonStructure([
            'message',
            'errors' => ['body']
        ]);
    }

    /** @test */
    public function a_status_body_requires_a_minimun_lenght()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('status.store', ['body' => 'asdf']));

        $response->assertJsonStructure([
            'message',
            'errors' => ['body']
        ]);
    }
}
