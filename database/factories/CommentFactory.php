<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Status;
use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(),
        'status_id' => factory(Status::class)->create(),
        'user_id' => factory(User::class)->create()
    ];
});
