<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanSeeProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_user_profile()
    {
        $this->withExceptionHandling();

        factory(User::class)->create(['name' => 'Albert']);

        $this->get('@Albert')->assertSee('Albert');
    }
}
