<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'author_id' => function () {
            return factory(App\People::class)->create()->getKey();
        }
    ];
});