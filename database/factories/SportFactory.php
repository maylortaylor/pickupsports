<?php

use Faker\Generator as Faker;

$factory->define(App\Sport::class, function (Faker $faker) {
    return [
        //
        'title' => substr($faker->sentence(2),0, -1),
        'description' => $faker->paragraph
    ];
});
