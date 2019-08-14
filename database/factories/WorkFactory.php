<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Work;
use Faker\Generator as Faker;

$factory->define(Work::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
//        'content' => $faker->sentence(),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
