<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Concert;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Concert::class, function (Faker $faker) {
    return [
        'concert_date' => $faker->date($format = 'YYYY-mm-dd'),
        'setlist' => $faker->text,
        'concert_type_id' => $faker->randomNumber(1),
        'artist_id' => $faker->randomNumber(1),
        'venue_id' => $faker->randomNumber(1),
    ];
});
