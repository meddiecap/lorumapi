<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create genres
        $genres = [
            'Action',
            'Comedy',
            'Drama',
            'Science Fiction',
            'Horror',
            'Romance',
            'Thriller',
            'Documentary',
            'Animation',
            'Fantasy'
        ];

        $genreModels = [];
        foreach ($genres as $genreName) {
            $genreModels[] = Genre::factory()->create([
                'name' => $genreName,
            ]);
        }

        // Create directors
        $directors = [
            [
                'name' => 'Christopher Nolan',
                'birth_date' => '1970-07-30',
            ],
            [
                'name' => 'Steven Spielberg',
                'birth_date' => '1946-12-18',
            ],
            [
                'name' => 'Quentin Tarantino',
                'birth_date' => '1963-03-27',
            ],
            [
                'name' => 'Martin Scorsese',
                'birth_date' => '1942-11-17',
            ],
            [
                'name' => 'Greta Gerwig',
                'birth_date' => '1983-08-04',
            ],
        ];

        $directorModels = [];
        foreach ($directors as $directorData) {
            $directorModels[] = Director::factory()->create($directorData);
        }

        // Create movies
        $movies = [
            [
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'release_year' => 2010,
                'rating' => 4.8,
                'genre_id' => $genreModels[3]->id, // Science Fiction
                'director_id' => $directorModels[0]->id, // Christopher Nolan
            ],
            [
                'title' => 'Jurassic Park',
                'description' => 'A pragmatic paleontologist visiting an almost complete theme park is tasked with protecting a couple of kids after a power failure causes the park\'s cloned dinosaurs to run loose.',
                'release_year' => 1993,
                'rating' => 4.7,
                'genre_id' => $genreModels[3]->id, // Science Fiction
                'director_id' => $directorModels[1]->id, // Steven Spielberg
            ],
            [
                'title' => 'Pulp Fiction',
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'release_year' => 1994,
                'rating' => 4.9,
                'genre_id' => $genreModels[6]->id, // Thriller
                'director_id' => $directorModels[2]->id, // Quentin Tarantino
            ],
            [
                'title' => 'The Departed',
                'description' => 'An undercover cop and a mole in the police attempt to identify each other while infiltrating an Irish gang in South Boston.',
                'release_year' => 2006,
                'rating' => 4.6,
                'genre_id' => $genreModels[2]->id, // Drama
                'director_id' => $directorModels[3]->id, // Martin Scorsese
            ],
            [
                'title' => 'Lady Bird',
                'description' => 'In 2002, an artistically inclined seventeen-year-old girl comes of age in Sacramento, California.',
                'release_year' => 2017,
                'rating' => 4.5,
                'genre_id' => $genreModels[2]->id, // Drama
                'director_id' => $directorModels[4]->id, // Greta Gerwig
            ],
            [
                'title' => 'The Dark Knight',
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'release_year' => 2008,
                'rating' => 4.9,
                'genre_id' => $genreModels[0]->id, // Action
                'director_id' => $directorModels[0]->id, // Christopher Nolan
            ],
            [
                'title' => 'E.T. the Extra-Terrestrial',
                'description' => 'A troubled child summons the courage to help a friendly alien escape Earth and return to his home world.',
                'release_year' => 1982,
                'rating' => 4.6,
                'genre_id' => $genreModels[9]->id, // Fantasy
                'director_id' => $directorModels[1]->id, // Steven Spielberg
            ],
            [
                'title' => 'Kill Bill: Vol. 1',
                'description' => 'After awakening from a four-year coma, a former assassin wreaks vengeance on the team of assassins who betrayed her.',
                'release_year' => 2003,
                'rating' => 4.7,
                'genre_id' => $genreModels[0]->id, // Action
                'director_id' => $directorModels[2]->id, // Quentin Tarantino
            ],
            [
                'title' => 'Goodfellas',
                'description' => 'The story of Henry Hill and his life in the mob, covering his relationship with his wife Karen Hill and his mob partners Jimmy Conway and Tommy DeVito in the Italian-American crime syndicate.',
                'release_year' => 1990,
                'rating' => 4.8,
                'genre_id' => $genreModels[2]->id, // Drama
                'director_id' => $directorModels[3]->id, // Martin Scorsese
            ],
            [
                'title' => 'Little Women',
                'description' => 'Jo March reflects back and forth on her life, telling the beloved story of the March sisters - four young women, each determined to live life on her own terms.',
                'release_year' => 2019,
                'rating' => 4.5,
                'genre_id' => $genreModels[2]->id, // Drama
                'director_id' => $directorModels[4]->id, // Greta Gerwig
            ],
        ];

        foreach ($movies as $movieData) {
            Movie::factory()->create($movieData);
        }
    }
}
