<?php

use Faker\Generator as Faker;

$factory->define(App\Rating::class, function (Faker $faker) {
    return [
        //
          'user_id' => 1,
          'book_id'=> 2,
          'rating'=> 4,
          
          
    ];
});
