<?php

use Illuminate\Database\Seeder;
use App\Rating;
use Faker\Generator as Faker;
class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Let's truncate our existing records to start from scratch.
        Rating::truncate();

        $faker = \Faker\Factory::create();
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 5; $i++) {
            Rating::create([
                'user_id' => $i + 1,
                'book_id' => $i + 1,
                'rating' => $i + 2,
                
            ]);
        }
    }
}
