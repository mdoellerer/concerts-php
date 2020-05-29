<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ConcertType;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(ConcertType::class, function (Faker $faker) {
    return [
        'description' => $faker->words,
    ];
});
