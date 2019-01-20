<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->randomElement(['PHP','Programming','JavaScript','Life','Travel','Coffee','Technology','Fun']),
        'vocabulary_id' => $faker->numberBetween(1,2),
    ];
});
