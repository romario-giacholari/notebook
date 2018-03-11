<?php

use Faker\Generator as Faker;

$factory->define(App\Conversation::class, function (Faker $faker) {
    return [
        'contact_id' => function() {
            return factory('App\Contact')->create()->id;
        },
        'topic' => $faker->title,
        'body' => $faker->text,
    ];
});
