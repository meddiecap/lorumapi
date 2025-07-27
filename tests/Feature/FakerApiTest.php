<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

it('can list all available faker resources', function () {
    // Act: Perform a GET request to the list-resources endpoint
    $response = $this->getJson('/api/faker/list-resources');

    // Assert: Response should be successful and have the correct structure
    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'code',
            'data' => [
                '*' => [
                    'name',
                    'class',
                    'route'
                ]
            ]
        ]);

    // Verify the response contains expected values
    $responseData = $response->json();
    expect($responseData['status'])->toBe('OK');
    expect($responseData['code'])->toBe(200);

    // Verify that the data array contains resources
    expect($responseData['data'])->toBeArray();
    expect($responseData['data'])->not->toBeEmpty();

    // Check that the Person resource is included
    $personResource = collect($responseData['data'])->firstWhere('name', 'Person');
    expect($personResource)->not->toBeNull();
    expect($personResource['class'])->toBe('App\\Http\\Resources\\Faker\\PersonResource');
    expect($personResource['route'])->toContain('/api/faker/people');
});

it('can retrieve a specific faker resource', function () {
    // Act: Perform a GET request to get the Person resource
    $response = $this->getJson('/api/faker/people');

    // Assert: Response should be successful and have the correct structure
    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'code',
            'total',
            'data' => [
                '*' => [
                    'id',
                    'firstname',
                    'lastname',
                    'email',
                    'phone',
                    'birthday',
                    'gender',
                    'address',
                    'website',
                    'image'
                ]
            ]
        ]);

    // Verify the response contains expected values
    $responseData = $response->json();
    expect($responseData['status'])->toBe('OK');
    expect($responseData['code'])->toBe(200);

    // By default, it should return 10 items
    expect($responseData['total'])->toBe(10);
    expect($responseData['data'])->toHaveCount(10);

    // Check that the first person has the expected structure
    $firstPerson = $responseData['data'][0];
    expect($firstPerson['id'])->toBe(1);
    expect($firstPerson['firstname'])->toBeString();
    expect($firstPerson['lastname'])->toBeString();
    expect($firstPerson['email'])->toBeString();
    expect($firstPerson['phone'])->toBeString();
    expect($firstPerson['gender'])->toBeIn(['male', 'female', 'other']);

    // Check that the address is an object with the expected structure
    expect($firstPerson['address'])->toBeArray();
    expect($firstPerson['address'])->toHaveKeys(['street', 'street_name', 'building_number', 'city', 'postcode', 'country']);
});

it('returns 404 when requesting a non-existent resource', function () {
    // Act: Perform a GET request with a non-existent resource
    $response = $this->getJson('/api/faker/non-existent-resource');

    // Assert: Response should be a 404 with the correct error message
    $response->assertStatus(404)
        ->assertJsonStructure([
            'status',
            'code',
            'message'
        ]);

    // Verify the response contains expected values
    $responseData = $response->json();
    expect($responseData['status'])->toBe('Error');
    expect($responseData['code'])->toBe(404);
    expect($responseData['message'])->toContain("Resource 'NonExistentResource' not found");
    expect($responseData['message'])->toContain(route('faker.list'));
});

it('can customize the quantity of returned resources', function () {
    // Act: Perform a GET request with a custom quantity
    $response = $this->getJson('/api/faker/people?quantity=5');

    // Assert: Response should return the requested number of items
    $response->assertStatus(200);

    $responseData = $response->json();
    expect($responseData['total'])->toBe(5);
    expect($responseData['data'])->toHaveCount(5);

    // Check that the IDs are sequential
    expect($responseData['data'][0]['id'])->toBe(1);
    expect($responseData['data'][4]['id'])->toBe(5);
});

it('can use a seed for consistent results', function () {
    // Act: Perform two GET requests with the same seed
    $response1 = $this->getJson('/api/faker/people?seed=12345&quantity=3');
    $response2 = $this->getJson('/api/faker/people?seed=12345&quantity=3');

    // Assert: Both responses should have the same data
    $response1->assertStatus(200);
    $response2->assertStatus(200);

    $data1 = $response1->json('data');
    $data2 = $response2->json('data');

    // Compare the first names of each person
    expect($data1[0]['firstname'])->toBe($data2[0]['firstname']);
    expect($data1[1]['firstname'])->toBe($data2[1]['firstname']);
    expect($data1[2]['firstname'])->toBe($data2[2]['firstname']);

    // Compare the last names of each person
    expect($data1[0]['lastname'])->toBe($data2[0]['lastname']);
    expect($data1[1]['lastname'])->toBe($data2[1]['lastname']);
    expect($data1[2]['lastname'])->toBe($data2[2]['lastname']);
});

it('can use a different locale for localized results', function () {
    // Act: Perform GET requests with different locales
    $responseEn = $this->getJson('/api/faker/people?locale=en_US&seed=12345&quantity=1');
    $responseFr = $this->getJson('/api/faker/people?locale=fr_FR&seed=12345&quantity=1');

    // Assert: Responses should have different localized data
    $responseEn->assertStatus(200);
    $responseFr->assertStatus(200);

    $dataEn = $responseEn->json('data')[0];
    $dataFr = $responseFr->json('data')[0];

    // The names should be different due to different locales
    expect($dataEn['firstname'])->not->toBe($dataFr['firstname']);

    // The addresses should have different country values
    expect($dataEn['address']['country'])->not->toBe($dataFr['address']['country']);
});

it('can filter by gender for person resources', function () {
    // Act: Perform GET requests with gender filter
    $response = $this->getJson('/api/faker/people?gender=female&quantity=5&seed=12345');

    // Assert: All returned people should have the specified gender
    $response->assertStatus(200);

    $data = $response->json('data');
    expect($data)->toHaveCount(5);

    // Check that all people have the female gender
    foreach ($data as $person) {
        expect($person['gender'])->toBe('female');
    }
});

it('respects the maximum quantity limit', function () {
    // Get the maximum limit from the config
    $maxLimit = config('api.response_limit_number', 1000);

    // Act: Perform a GET request with a quantity exceeding the limit
    $response = $this->getJson('/api/faker/people?quantity=' . ($maxLimit + 100));

    // Assert: Response should limit the quantity to the maximum
    $response->assertStatus(200);

    $responseData = $response->json();
    expect($responseData['total'])->toBe($maxLimit);
    expect($responseData['data'])->toHaveCount($maxLimit);
});
