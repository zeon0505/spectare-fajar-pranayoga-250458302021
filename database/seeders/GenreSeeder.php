<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Action'],
            ['name' => 'Drama'],
            ['name' => 'Comedy'],
            ['name' => 'Horror'],
            ['name' => 'Romance'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Animation'],
            ['name' => 'Adventure'],
            ['name' => 'Thriller'],
            ['name' => 'Mystery'],
            ['name' => 'Documentary'],
            ['name' => 'Anime'],
            ['name' => 'Supernatural'],
            ['name' => 'War'],
        ];

        foreach ($genres as $genre) {
            Genre::updateOrCreate(['name' => $genre['name']], $genre);
        }
    }
}
