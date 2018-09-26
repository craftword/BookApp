<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        //
         'title' => $faker->sentence,
          'description'=> $faker->paragraph,
          'author'=> $faker->name,
          'dateOfPublication' => $faker->date,
          'user_id' => 1,
    ];
});
