<?php

use Faker\Generator as Faker;

$factory->define(App\Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'amount' => $faker->numberBetween(1, 5),
        'depleted_at' => null,
    ];
});
