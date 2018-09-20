<?php

use Illuminate\Database\Seeder;
use App\Book;
use Faker\Generator as Faker;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Book::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 10; $i++) {
            Book::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'author' => $faker->name,
                'dateOfPublication'=> $faker->date,
                'user_id' => $i + 1,
            ]);
        }
    }
}
