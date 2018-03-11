<?php

use Faker\Generator as Faker;

$factory->define(App\Journal::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'event' => $faker->title,
        'learned' => $faker->paragraph,
        'well' => $faker->paragraph,
        'better' => $faker->paragraph,
        'implications' => $faker->paragraph
    ];
});
