<?php

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Movie;

uses(RefreshDatabase::class);

it('returns empty when no movies exist', function () {
    $response = $this->getJson('/api/movies');

    $response->assertStatus(200)
        ->assertJsonCount(0, 'data');
});

it('can retrieve a list of movies', function () {
    // Arrange: Create some movies in the database
    Movie::factory()->count(3)->create();

    // Act: Make a GET request to the API
    $response = $this->getJson('/api/movies?page=1&per_page=3');

    // Assert: Check if the response is correct
    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'description', 'created_at', 'updated_at']
            ]
        ]);
});

it('can retrieve a paginated list of movies', function () {
    // Arrange: Create 15 movies in the database
    Movie::factory()->count(15)->create();

    // Act: Make a GET request to the API with pagination
    $response = $this->getJson('/api/movies?page=1&per_page=10');

    // Assert: Verify the response structure and pagination metadata
    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'description', 'created_at', 'updated_at']
            ],
            'meta' => [
                'total', 'per_page', 'current_page', 'last_page', 'from', 'to'
            ],
            'links' => [
                'first', 'last', 'next', 'prev'
            ]
        ]);

    // Verify the correct number of movies on the first page
    $responseData = $response->json();
    expect($responseData['data'])->toHaveCount(10);
    expect($responseData['meta']['total'])->toBe(15);
    expect($responseData['meta']['current_page'])->toBe(1);
    expect($responseData['meta']['last_page'])->toBe(2);
});

it('can retrieve the second page of movies', function () {
    // Arrange: Create 15 movies in the database
    Movie::factory()->count(15)->create();

    // Act: Make a GET request for the second page
    $response = $this->getJson('/api/movies?page=2&per_page=10');

    // Assert: Verify the response structure and data
    $response->assertStatus(200);

    $responseData = $response->json();
    expect($responseData['data'])->toHaveCount(5);
    expect($responseData['meta']['current_page'])->toBe(2);
    expect($responseData['meta']['from'])->toBe(11);
    expect($responseData['meta']['to'])->toBe(15);
});

it('can filter movies by genre and release date', function () {
    // Arrange: Create test genres
    $actionGenre = Genre::factory()->create(['name' => 'Action']);
    $dramaGenre = Genre::factory()->create(['name' => 'Drama']);
    $sciFiGenre = Genre::factory()->create(['name' => 'Sci-Fi']);

    // Create movies and associate them with genres
    Movie::factory()->create(['title' => 'Action Movie', 'genre_id' => $actionGenre->id, 'release_year' => 2023]);
    Movie::factory()->create(['title' => 'Drama Movie', 'genre_id' => $dramaGenre->id, 'release_year' => 2022]);
    Movie::factory()->create(['title' => 'Sci-Fi Movie', 'genre_id' => $sciFiGenre->id, 'release_year' => 2023]);

    // Act: Filter movies by genre and release year
    $response = $this->getJson('/api/movies?genre=Action&release_year=2023');

    // Assert: Ensure only the correct movie is returned
    $response->assertStatus(200)
        ->assertJsonCount(1, 'data') // Only one movie matches the filters
        ->assertJsonFragment([
            'title' => 'Action Movie',
            'release_year' => 2023,
        ])
        ->assertJsonPath('data.0.genre.name', 'Action') // Ensure correct genre association
        ->assertJsonMissing(['genre' => ['created_at', 'updated_at']]); // Ensure only name and id are returned for the genre
});

it('can filter movies by genre, release year, min rating, and max rating', function () {
    // Arrange: Create genres
    $actionGenre = Genre::factory()->create(['name' => 'Action']);
    $dramaGenre = Genre::factory()->create(['name' => 'Drama']);
    $sciFiGenre = Genre::factory()->create(['name' => 'Sci-Fi']);

    // Arrange: Maak testfilms aan in de database met verschillende ratings
    Movie::factory()->create(['title' => 'Action Movie Low', 'genre_id' => $actionGenre->id, 'release_year' => 2023, 'rating' => 5]);
    Movie::factory()->create(['title' => 'Action Movie High', 'genre_id' => $actionGenre->id, 'release_year' => 2023, 'rating' => 8]);
    Movie::factory()->create(['title' => 'Drama Movie', 'genre_id' => $dramaGenre->id, 'release_year' => 2022, 'rating' => 7]);
    Movie::factory()->create(['title' => 'Sci-Fi Movie', 'genre_id' => $sciFiGenre->id, 'release_year' => 2023, 'rating' => 9]);

    // Act: Make a GET request with multiple filters
    $response = $this->getJson('/api/movies?genre=Action&release_year=2023&min_rating=6&max_rating=8');

    // Assert: Check if the correct movie is returned and others are excluded
    $response->assertStatus(200)
        ->assertJsonCount(1, 'data') // There is only one movie that matches all criteria
        ->assertJsonFragment([
            'title' => 'Action Movie High',
            'release_year' => 2023,
            'rating' => 8,
        ])
        ->assertJsonPath('data.0.genre.name', 'Action') // Ensure the correct genre is associated
        ->assertJsonMissing([
            'title' => 'Action Movie Low', // This one has a rating below the minimum
        ])
        ->assertJsonMissing([
            'title' => 'Sci-Fi Movie', // This one has a rating above the maximum
        ]);
});

it('can filter movies by different criteria', function ($filters, $expectedCount, $expectedTitle) {
    // Arrange: Create genres
    $actionGenre = Genre::factory()->create(['name' => 'Action']);
    $dramaGenre = Genre::factory()->create(['name' => 'Drama']);

    // Create movies with genres
    Movie::factory()->create(['title' => 'Action Movie', 'genre_id' => $actionGenre->id, 'release_year' => 2023, 'rating' => 8]);
    Movie::factory()->create(['title' => 'Drama Movie', 'genre_id' => $dramaGenre->id, 'release_year' => 2022, 'rating' => 7]);

    // Act: Make a GET request with filters
    $response = $this->getJson('/api/movies?' . http_build_query($filters));

    // Assert: Check if the correct number of movies is returned
    $response->assertStatus(200)
        ->assertJsonCount($expectedCount, 'data');

    if ($expectedTitle) {
        $response->assertJsonPath('data.0.title', $expectedTitle);
    }
})->with([
    [['genre' => 'Action'], 1, 'Action Movie'],
    [['release_year' => 2022], 1, 'Drama Movie'],
    [['min_rating' => 8], 1, 'Action Movie'],
    [['max_rating' => 6], 0, null], // No movie should match
]);

it('returns validation error for invalid filter values', function () {
    $response = $this->getJson('/api/movies?min_rating=-1');

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['min_rating']);
});

it('can sort movies by release year in ascending and descending order', function () {
    // Arrange: Create test movies with different release years
    Movie::factory()->create(['title' => 'Movie 2021', 'release_year' => 2021]);
    Movie::factory()->create(['title' => 'Movie 2022', 'release_year' => 2022]);
    Movie::factory()->create(['title' => 'Movie 2023', 'release_year' => 2023]);

    // Act: Perform a GET request for ascending order (asc)
    $responseAsc = $this->getJson('/api/movies?sort=release_year&order=asc');

    // Assert: Verify movies are sorted in ascending order (2021 -> 2022 -> 2023)
    $responseAsc->assertStatus(200)
        ->assertJsonPath('data.0.release_year', 2021)
        ->assertJsonPath('data.1.release_year', 2022)
        ->assertJsonPath('data.2.release_year', 2023);

    // Act: Perform a GET request for descending order (desc)
    $responseDesc = $this->getJson('/api/movies?sort=release_year&order=desc');

    // Assert: Verify movies are sorted in descending order (2023 -> 2022 -> 2021)
    $responseDesc->assertStatus(200)
        ->assertJsonPath('data.0.release_year', 2023)
        ->assertJsonPath('data.1.release_year', 2022)
        ->assertJsonPath('data.2.release_year', 2021);

    // Act: Perform a GET request for ascending order without specifying the order
    $responseDesc = $this->getJson('/api/movies?sort=release_year');

    // Assert: Verify movies are sorted in ascending order (2021 -> 2022 -> 2023)
    $responseDesc->assertStatus(200)
        ->assertJsonPath('data.0.release_year', 2021)
        ->assertJsonPath('data.1.release_year', 2022)
        ->assertJsonPath('data.2.release_year', 2023);
});

it('ensures a movie is correctly associated with a genre', function () {
    // Arrange: Create a genre and a movie
    $genre = Genre::factory()->create(['name' => 'Thriller']);
    $movie = Movie::factory()->create(['title' => 'Suspense Movie', 'genre_id' => $genre->id]);

    // Assert: Check if the movie's genre relation is set correctly in the database
    expect($movie->genre)->not->toBeNull();
    expect($movie->genre->id)->toBe($genre->id);
    expect($movie->genre->name)->toBe('Thriller');
});
