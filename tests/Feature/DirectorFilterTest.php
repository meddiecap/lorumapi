<?php

use App\Models\Director;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can filter directors by name', function () {
    $directors = Director::factory()->count(3)->create();

    $response = $this->get('/api/directors?name=' . $directors[1]->name);

    $response->assertJsonCount(1, 'data')
        ->assertJsonFragment(['name' => $directors[1]->name]);
});

it('can sort directors by name', function () {
    $directors = collect(['Zack Snyder', 'Christopher Nolan', 'Martin Scorsese'])->map(function ($name) {
        return Director::factory()->create(['name' => $name]);
    });

    $response = $this->get('/api/directors?sort=name');

    $response->assertJsonCount(3, 'data')
        ->assertSeeInOrder([$directors[1]->name, $directors[2]->name, $directors[0]->name]);
});

it('ignores non-existing filter keys', function () {
    Director::factory()->count(3)->create();

    $response = $this->get('/api/directors?non_existing_key=non_existing_value');

    $response->assertJsonCount(3, 'data');
});

it('can filter directors by having movies', function () {
    $directors = Director::factory()->count(3)->create();

    $directors[0]->movies()->create(['title' => 'The Dark Knight', 'release_year' => '2008']);
    $directors[1]->movies()->create(['title' => 'Inception', 'release_year' => '2010']);

    $response = $this->get('/api/directors?has_movies=true');

    $response->assertJsonCount(2, 'data')
        ->assertJsonFragment(['name' => $directors[0]->name])
        ->assertJsonFragment(['name' => $directors[1]->name]);
});

it('can filter directors by not having movies', function () {
    $directors = Director::factory()->count(3)->create();

    $directors[0]->movies()->create(['title' => 'The Dark Knight', 'release_year' => '2008']);
    $directors[1]->movies()->create(['title' => 'Inception', 'release_year' => '2010']);

    $response = $this->get('/api/directors?has_movies=false');

    $response->assertJsonCount(1, 'data')
        ->assertJsonFragment(['name' => $directors[2]->name]);
});
