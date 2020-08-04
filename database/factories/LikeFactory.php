<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\User;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
    	'status_id' => factory(Status::class)->create(),
    	'user_id' => factory(User::class)->create()
    ];
});
