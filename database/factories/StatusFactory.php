<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => factory(User::class)->create()
    ];
});
