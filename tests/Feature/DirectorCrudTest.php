<?php

use App\Models\director;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a director', function () {
    // Act: Make a POST request to create a director
    $response = $this->postJson('/api/directors', [
        'name' => 'Test Director',
    ]);

    // Assert: Check if the director was created successfully
    $response->assertStatus(201)
        ->assertJsonFragment([
            'name' => 'Test Director',
        ]);
});

it('can retrieve a director', function () {
    // Arrange: Create a director
    $director = Director::factory()->create();

    // Act: Make a GET request to retrieve the director
    $response = $this->getJson("/api/directors/{$director->id}");

    // Assert: Check if the director was retrieved successfully
    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => $director->name,
        ]);
});

it('can update a director', function () {
    // Arrange: Create a director
    $director = Director::factory()->create();

    // Act: Make a PUT request to update the director
    $response = $this->putJson("/api/directors/{$director->id}", [
        'name' => 'Updated director',
    ]);

    // Assert: Check if the director was updated successfully
    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => 'Updated director',
        ]);
});

it('can delete a director', function () {
    // Arrange: Create a director
    $director = Director::factory()->create();

    // Act: Make a DELETE request to delete the director
    $response = $this->deleteJson("/api/directors/{$director->id}");

    // Assert: Check if the director was deleted successfully
    $response->assertStatus(204);

    // Check if the director was deleted from the database
    $this->assertDatabaseMissing('directors', ['id' => $director->id]);
});

it('deleting a director does not delete associated movies', function () {
    // Arrange: Create a director and a movie associated with the director
    $director = Director::factory()->create();
    $movie = Movie::factory()->create(['director_id' => $director->id]);

    // Act: Delete the director
    $response = $this->deleteJson("/api/directors/{$director->id}");

    // Assert: Check if the director was deleted successfully
    $response->assertStatus(204);

    // Check if the movie still exists in the database
    $this->assertDatabaseHas('movies', ['id' => $movie->id]);
});
