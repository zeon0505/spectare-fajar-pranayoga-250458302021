<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = \App\Models\Genre::all();

        $films = [
            [
                'title' => 'John Wick: Chapter 4',
                'description' => 'John Wick (Keanu Reeves) menemukan jalan untuk mengalahkan The High Table. Namun sebelum dia bisa mendapatkan kebebasannya, Wick harus berhadapan dengan musuh baru dengan aliansi kuat di seluruh dunia.',
                'release_date' => '2023-03-24',
                'duration' => 169,
                'status' => 'Now Showing',
                'poster_url' => 'films/john-wick-4.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/yjRHZEUamCc',
                'ticket_price' => 50000,
                'age_rating' => 'D17+',
                'genre_names' => ['Action', 'Thriller']
            ],
            [
                'title' => 'Interstellar',
                'description' => 'Sekelompok penjelajah melakukan perjalanan melalui lubang cacing di luar angkasa dalam upaya untuk memastikan kelangsungan hidup umat manusia.',
                'release_date' => '2014-11-07',
                'duration' => 169,
                'status' => 'Now Showing',
                'poster_url' => 'films/interstellar.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/zSWdZVtXT7E',
                'ticket_price' => 45000,
                'age_rating' => 'SU',
                'genre_names' => ['Sci-Fi', 'Adventure', 'Drama']
            ],
            [
                'title' => 'The Conjuring: The Devil Made Me Do It',
                'description' => 'Ed dan Lorraine Warren menyelidiki pembunuhan yang mungkin terkait dengan kerasukan iblis.',
                'release_date' => '2021-06-04',
                'duration' => 112,
                'status' => 'Now Showing',
                'poster_url' => 'films/conjuring-3.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/h9Q4zZS2v1k',
                'ticket_price' => 40000,
                'age_rating' => 'D17+',
                'genre_names' => ['Horror', 'Mystery', 'Thriller']
            ],
            [
                'title' => 'Suzume',
                'description' => 'Seorang gadis berusia 17 tahun bernama Suzume membantu seorang pemuda misterius menutup pintu yang melepaskan bencana di seluruh Jepang.',
                'release_date' => '2022-11-11',
                'duration' => 122,
                'status' => 'Now Showing',
                'poster_url' => 'films/suzume.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/fvW_AsX_qP0',
                'ticket_price' => 45000,
                'age_rating' => 'R13+',
                'genre_names' => ['Animation', 'Adventure', 'Fantasy', 'Anime']
            ],
            [
                'title' => 'The Super Mario Bros. Movie',
                'description' => 'Kisah Mario dan Luigi saat mereka melintasi Kerajaan Jamur.',
                'release_date' => '2023-04-05',
                'duration' => 92,
                'status' => 'Now Showing',
                'poster_url' => 'films/mario.jpg',
                'trailer_url' => 'https://www.youtube.com/embed/TnGl01FkMMo',
                'ticket_price' => 35000,
                'age_rating' => 'SU',
                'genre_names' => ['Animation', 'Adventure', 'Comedy']
            ],
        ];

        foreach ($films as $filmData) {
            $genreNames = $filmData['genre_names'];
            unset($filmData['genre_names']);

            $film = \App\Models\Film::updateOrCreate(
                ['title' => $filmData['title']],
                $filmData
            );

            $genreIds = \App\Models\Genre::whereIn('name', $genreNames)->pluck('id');
            $film->genres()->sync($genreIds);
        }
    }
}
