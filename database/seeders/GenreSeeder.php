<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action',
            'Adventure',
            'Comedy',
            'Drama',
            'Romance',
            'Horror',
            'Thriller',
            'Mystery',
            'Crime',
            'Fantasy',
            'Science Fiction',
            'Superhero',
            'Animation',
            'Family',
            'Musical',
            'Documentary',
            'Biography',
            'History',
            'War',
            'Western',
            'Sports',
            'Slice of Life',
            'Mythology',
            'Time Travel',
            'Survival',
            'Revenge',
            'Heist',
            'Religious',
            'Post-Apocalyptic',
            'Martial Arts',
            'Zombie',
            'Supernatural',
            'Romantic Comedy',
        ];

        foreach ($genres as $name) {
            Genre::firstOrCreate(['name' => $name]);
        }
    }
}
