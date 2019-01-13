<?php

use Faker\Generator as Faker;

$factory->define(App\CommentReply::class, function (Faker $faker) {
    return [
        //
        'comment_id' => $faker->numberBetween(1,10),
        'is_active' => 1,
        'author' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'body' => $faker->paragraphs(1,true),
        'photo' => 'placeholder.jpg',
    ];
});
