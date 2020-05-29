<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Venue;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Venue::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});