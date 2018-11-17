<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'name'=>$faker->word,
        'details'=> $faker->paragraph,
    ];
});
