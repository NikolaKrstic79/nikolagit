<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            [
                'title' => 'The Shawshank Redemption',
                'year' => 1994,
                'director' => 'Frank Darabont',
                'writer' => 'Stephen King',
                'stars' => 'Tim Robbins, Morgan Freeman',
                'image_url' => 'https://example.com/shawshank.jpg',
                'trailer_url' => 'https://www.youtube.com/watch?v=6hB3S9bIaco',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Godfather',
                'year' => 1972,
                'director' => 'Francis Ford Coppola',
                'writer' => 'Mario Puzo, Francis Ford Coppola',
                'stars' => 'Marlon Brando, Al Pacino, James Caan',
                'image_url' => 'https://example.com/godfather.jpg',
                'trailer_url' => 'https://www.youtube.com/watch?v=sY1S34973zA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more movies as needed
        ]);
    }
}

