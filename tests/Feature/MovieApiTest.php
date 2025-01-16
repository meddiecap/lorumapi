<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Movie;

uses(RefreshDatabase::class);

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
