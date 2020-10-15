<?php

namespace Tests\Feature;

use App\User;
use App\Status;
use Tests\TestCase;
use App\Events\StatusCreated;
use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Broadcast;

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
    public function authenticated_user_can_create_statuses()
    {
        Event::fake([StatusCreated::class]);
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->postJson(route('status.store', ['body' => 'mi primer status']));

        $this->assertDatabaseHas('statuses', [
            'body' => 'mi primer status',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function an_event_is_fired_when_a_status_is_created()
    {
        Event::fake([StatusCreated::class]);
        Broadcast::shouldReceive('socket')->andReturn('socket-id');

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->actingAs($user)->postJson(route('status.store', ['body' => 'mi primer status']));

        Event::assertDispatched(StatusCreated::class, function($event){
            $this->assertInstanceOf(ShouldBroadcast::class, $event);
            $this->assertInstanceOf(StatusResource::class, $event->status);
            $this->assertEquals(Status::first()->id, $event->status->id);
            $this->assertEquals(
                'socket-id',
                $event->socket,
                "The event StatusCreated must call method dontBroadcastToCurrentUser in the constructor"
            );
            return true;
        });
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
