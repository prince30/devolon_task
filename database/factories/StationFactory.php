<?php

use Faker\Generator as Faker;

$factory->define(App\Station::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'company_id' => null
    ];
});
