<?php

namespace Tests\Feature;

use App\User;
use App\Status;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_users_canon_create_comments_for_statuses()
    {
        $status = factory(Status::class)->create();

        $this->postJson(route('statuses.comments.store', $status, ['body' => 'first comment']))
            ->assertStatus(401);
    }

    /** @test */
    public function authenticated_users_can_create_comments_for_statuses()
    {
        $this->withExceptionHandling();

        $status = factory(Status::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->postJson(route('statuses.comments.store', $status->id), ['body' => 'first comment']);

        $this->assertDatabaseCount('comments', 1);
        $this->assertDatabaseHas('comments', [
            'body' => 'first comment',
            'status_id' => $status->id,
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function a_comment_body_is_required()
    {
        $status = factory(Status::class)->create();
        $this->actingAs(factory(User::class)->create());

        $this->postJson(route('statuses.comments.store', $status->id), ['body' => ''])
            ->assertJsonStructure([
                'message',
                'errors' => ['body']
            ]);
    }
}
