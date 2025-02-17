<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Director;

uses(RefreshDatabase::class);

it('returns empty when no directors exist', function () {
    // Act: Perform a GET request
    $response = $this->getJson('/api/directors');

    // Assert: Response should be empty
    $response->assertStatus(200)
        ->assertJsonCount(0, 'data');
});

it('can retrieve a list of directors', function () {
    // Arrange: Create test directors
    Director::factory()->count(3)->create();

    // Act: Perform a GET request
    $response = $this->getJson('/api/directors?page=1&per_page=3');

    // Assert: Check if the response is correct
    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'created_at', 'updated_at']
            ]
        ]);
});

it('can retrieve a paginated list of directors', function () {
    // Arrange: Create 15 directors
    Director::factory()->count(15)->create();

    // Act: Perform a GET request with pagination
    $response = $this->getJson('/api/directors?page=1&per_page=10');

    // Assert: Verify pagination structure
    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'created_at', 'updated_at']
            ],
            'meta' => [
                'total', 'per_page', 'current_page', 'last_page', 'from', 'to'
            ],
            'links' => [
                'first', 'last', 'next', 'prev'
            ]
        ]);

    // Check the correct number of directors on page 1
    $responseData = $response->json();
    expect($responseData['data'])->toHaveCount(10);
    expect($responseData['meta']['total'])->toBe(15);
    expect($responseData['meta']['current_page'])->toBe(1);
    expect($responseData['meta']['last_page'])->toBe(2);
});

it('can retrieve the second page of directors', function () {
    // Arrange: Create 15 directors
    Director::factory()->count(15)->create();

    // Act: Perform a GET request for the second page
    $response = $this->getJson('/api/directors?page=2&per_page=10');

    // Assert: Verify second page response
    $response->assertStatus(200);

    $responseData = $response->json();
    expect($responseData['data'])->toHaveCount(5);
    expect($responseData['meta']['current_page'])->toBe(2);
    expect($responseData['meta']['from'])->toBe(11);
    expect($responseData['meta']['to'])->toBe(15);
});
