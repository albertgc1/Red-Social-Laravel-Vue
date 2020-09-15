<?php

namespace Tests\Feature\users;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_users()
    {
        $this->withExceptionHandling();

        $user = [
            'name' => 'Albertgc',
            'first_name' => 'Albert',
            'last_name' => 'Cuiza',
            'email' => 'albert@gmail.com',
            'password' => 'albert123',
            'password_confirmation' => 'albert123'
        ];

        $response = $this->postJson(route('register'), $user)->assertCreated();

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'Albertgc',
            'first_name' => 'Albert',
            'last_name' => 'Cuiza',
            'email' => 'albert@gmail.com',
        ]);
    }

    /** @test */
    public function the_name_is_required()
    {
        $user = factory(User::class)->raw(['name' => '']);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_name_must_be_a_string()
    {
        $user = factory(User::class)->raw(['name' => 4258]);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_name_cannon_have_more_than_60_caracters()
    {
        $user = factory(User::class)->raw(['name' => Str::random(65)]);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_first_name_is_required()
    {
        $user = factory(User::class)->raw(['first_name' => '']);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_first_name_must_be_a_string()
    {
        $user = factory(User::class)->raw(['first_name' => 4258]);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_first_name_cannon_have_more_than_60_caracters()
    {
        $user = factory(User::class)->raw(['first_name' => Str::random(65)]);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_last_name_is_required()
    {
        $user = factory(User::class)->raw(['last_name' => '']);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_last_name_must_be_a_string()
    {
        $user = factory(User::class)->raw(['last_name' => 4258]);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_last_name_cannon_have_more_than_60_caracters()
    {
        $user = factory(User::class)->raw(['last_name' => Str::random(65)]);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_email_is_required()
    {
        $user = factory(User::class)->raw(['email' => '']);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_email_is_a_valid_string()
    {
        $user = factory(User::class)->raw(['email' => 'invalidemail']);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_email_must_be_unique()
    {
        factory(User::class)->create(['email' => 'albert@gmail.com']);
        $user = factory(User::class)->raw(['email' => 'albert@gmail.com']);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }

    /** @test */
    public function the_user_name_only_contain_letters_and_numbres()
    {
        $user = factory(User::class)->raw(['name' => 'Albertgc7*-']);
        
        $this->postJson(route('register'), $user)->assertStatus(422);

        $this->assertDatabaseMissing('users', $user);
    }
}
