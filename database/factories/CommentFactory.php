<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->text,
        'article_id' => function () {
            return factory(App\Article::class)->create()->getKey(); // Get the value of the model's primary key.
        },
        'author_id' => function () {
            return factory(App\People::class)->create()->getKey();
        }
    ];
});
