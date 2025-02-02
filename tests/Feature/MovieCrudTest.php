<?php

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Movie;

uses(RefreshDatabase::class);

it('a movie can be created', function () {
    // Arrange: Create a genre
    $genre = Genre::factory()->create();

    // Act: Make a POST request to create a movie
    $response = $this->postJson('/api/movies', [
        'title' => 'Test Movie',
        'description' => 'This is a test movie',
        'release_year' => 2023,
        'rating' => 7.5,
        'genre_id' => $genre->id,
    ]);

    // Assert: Check if the movie was created successfully
    $response->assertStatus(201)
        ->assertJsonFragment([
            'title' => 'Test Movie',
            'description' => 'This is a test movie',
            'release_year' => 2023,
            'rating' => 7.5,
        ])
        ->assertJsonPath('data.genre.name', $genre->name);
});

it('a movie can be retrieved', function () {
    $genre = Genre::factory()->create();

    // Arrange: Create a movie
    $movie = Movie::factory()->create(['genre_id' => $genre->id]);

    // Act: Make a GET request to retrieve the movie
    $response = $this->getJson("/api/movies/{$movie->id}");

    // Assert: Check if the movie was retrieved successfully
    $response->assertStatus(200)
        ->assertJsonFragment([
            'title' => $movie->title,
            'description' => $movie->description,
            'release_year' => $movie->release_year,
            'rating' => $movie->rating,
        ])
        ->assertJsonPath('data.genre.name', $genre->name);
});

it('a movie can be updated', function () {
    // Arrange: Create a movie
    $movie = Movie::factory()->create();

    // Act: Make a PUT request to update the movie
    $response = $this->putJson("/api/movies/{$movie->id}", [
        'title' => 'Updated Movie',
        'description' => 'This is an updated movie',
        'release_year' => 2022,
        'rating' => 8.0,
    ]);

    // Assert: Check if the movie was updated successfully
    $response->assertStatus(200)
        ->assertJsonFragment([
            'title' => 'Updated Movie',
            'description' => 'This is an updated movie',
            'release_year' => 2022,
            'rating' => 8.0,
        ]);
});

it('a movie can be deleted', function () {
    // Arrange: Create a movie
    $movie = Movie::factory()->create();

    // Act: Make a DELETE request to delete the movie
    $response = $this->delete("/api/movies/{$movie->id}");

    // Assert: Check if the movie was deleted successfully
    $response->assertStatus(204);

    // Assert: Check if the movie no longer exists in the database
    $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
});
