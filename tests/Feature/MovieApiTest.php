<?php
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
    // Arrange: Create test movies in the database with different genres and release years
    Movie::factory()->create(['title' => 'Action Movie', 'genre' => 'action', 'release_year' => 2023]);
    Movie::factory()->create(['title' => 'Drama Movie', 'genre' => 'drama', 'release_year' => 2022]);
    Movie::factory()->create(['title' => 'Sci-Fi Movie', 'genre' => 'sci-fi', 'release_year' => 2023]);

    // Act:
    $response = $this->getJson('/api/movies?genre=action&release_year=2023');

    // Assert: Controleer of de gefilterde films correct worden geretourneerd
    $response->assertStatus(200)
        ->assertJsonCount(1, 'data') // Er is maar één film met dit genre en releasejaar
        ->assertJsonFragment([
            'title' => 'Action Movie',
            'genre' => 'action',
            'release_year' => 2023,
        ]);
});

it('can filter movies by genre, release year, min rating, and max rating', function () {
    // Arrange: Maak testfilms aan in de database met verschillende ratings
    Movie::factory()->create(['title' => 'Action Movie Low', 'genre' => 'action', 'release_year' => 2023, 'rating' => 5]);
    Movie::factory()->create(['title' => 'Action Movie High', 'genre' => 'action', 'release_year' => 2023, 'rating' => 8]);
    Movie::factory()->create(['title' => 'Drama Movie', 'genre' => 'drama', 'release_year' => 2022, 'rating' => 7]);
    Movie::factory()->create(['title' => 'Sci-Fi Movie', 'genre' => 'sci-fi', 'release_year' => 2023, 'rating' => 9]);

    // Act: Make a GET request with multiple filters
    $response = $this->getJson('/api/movies?genre=action&release_year=2023&min_rating=6&max_rating=8');

    // Assert: Check if the correct movie is returned and others are excluded
    $response->assertStatus(200)
        ->assertJsonCount(1, 'data') // There is only one movie that matches all criteria
        ->assertJsonFragment([
            'title' => 'Action Movie High',
            'genre' => 'action',
            'release_year' => 2023,
            'rating' => 8,
        ])
        ->assertJsonMissing([
            'title' => 'Action Movie Low', // This one has a rating below the minimum
        ])
        ->assertJsonMissing([
            'title' => 'Sci-Fi Movie', // This one has a rating above the maximum
        ]);
});

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
