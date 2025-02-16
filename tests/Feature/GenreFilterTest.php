<?php

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Movie;

uses(RefreshDatabase::class);

it('can filter genres by name', function () {
    // Arrange: Create test genres
    Genre::factory()->create(['name' => 'Action']);
    Genre::factory()->create(['name' => 'Drama']);
    Genre::factory()->create(['name' => 'Sci-Fi']);

    // Act: Filter genres by name
    $response = $this->getJson('/api/genres?name=Action');

    // Assert: Ensure only the correct genre is returned
    $response->assertStatus(200)
        ->assertJsonCount(1, 'data') // Only one genre matches the filter
        ->assertJsonFragment([
            'name' => 'Action',
        ])
        ->assertJsonMissing(['created_at', 'updated_at']); // Ensure only name and id are returned for the genre
});

it('can sort genres by name', function () {
    // Arrange: Create test genres
    Genre::factory()->create(['name' => 'Action']);
    Genre::factory()->create(['name' => 'Drama']);
    Genre::factory()->create(['name' => 'Sci-Fi']);

    // Act: Sort genres by name in descending order
    $response = $this->getJson('/api/genres?sort=name&order=desc');

    // Assert: Ensure genres are sorted correctly
    $response->assertStatus(200)
        ->assertJsonPath('data.0.name', 'Sci-Fi')
        ->assertJsonPath('data.1.name', 'Drama')
        ->assertJsonPath('data.2.name', 'Action');
});

it('ignores non-existing filter keys', function () {
    // Arrange: Create test genres
    Genre::factory()->create(['name' => 'Action']);
    Genre::factory()->create(['name' => 'Drama']);
    Genre::factory()->create(['name' => 'Sci-Fi']);

    // Act: Filter genres by a non-existing key
    $response = $this->getJson('/api/genres?non_existing_key=Action');

    // Assert: Ensure all genres are returned
    $response->assertStatus(200)
        ->assertJsonCount(3, 'data');
});
