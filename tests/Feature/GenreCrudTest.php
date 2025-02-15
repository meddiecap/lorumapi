<?php

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a genre', function () {
    // Act: Make a POST request to create a genre
    $response = $this->postJson('/api/genres', [
        'name' => 'Action',
    ]);

    // Assert: Check if the genre was created successfully
    $response->assertStatus(201)
        ->assertJsonFragment([
            'name' => 'Action',
        ]);
});

it('can retrieve a genre', function () {
    // Arrange: Create a genre
    $genre = Genre::factory()->create();

    // Act: Make a GET request to retrieve the genre
    $response = $this->getJson("/api/genres/{$genre->id}");

    // Assert: Check if the genre was retrieved successfully
    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => $genre->name,
        ]);
});

it('can update a genre', function () {
    // Arrange: Create a genre
    $genre = Genre::factory()->create();

    // Act: Make a PUT request to update the genre
    $response = $this->putJson("/api/genres/{$genre->id}", [
        'name' => 'Updated Genre',
    ]);

    // Assert: Check if the genre was updated successfully
    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => 'Updated Genre',
        ]);
});

it('can delete a genre', function () {
    // Arrange: Create a genre
    $genre = Genre::factory()->create();

    // Act: Make a DELETE request to delete the genre
    $response = $this->deleteJson("/api/genres/{$genre->id}");

    // Assert: Check if the genre was deleted successfully
    $response->assertStatus(204);
});
