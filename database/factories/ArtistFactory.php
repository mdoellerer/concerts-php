<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Artist;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Artist::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'country' => $faker->country,
    ];
});
