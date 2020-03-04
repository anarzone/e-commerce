<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "details" => $faker->paragraph,
        "price" => $faker->randomFloat(3, 10, 5000),
        "stock" => $faker->numberBetween(1,500),
        "discount" => $faker->numberBetween(10, 75),
    ];
});
