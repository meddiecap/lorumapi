<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads_successfully(): void
    {
        // Create some test data
        $genre = Genre::factory()->create();
        $director = Director::factory()->create();
        Movie::factory()->create([
            'genre_id' => $genre->id,
            'director_id' => $director->id,
        ]);

        // Visit the homepage
        $response = $this->get(route('home'));

        // Assert the page loads successfully
        $response->assertStatus(200);

        // Assert the page contains the expected content
        $response->assertSee('Lorem Ipsum API');
        $response->assertSee('Welcome to the Lorem Ipsum API');
        $response->assertSee('API Endpoints');
        $response->assertSee('Movies');
        $response->assertSee('Directors');
        $response->assertSee('Genres');
    }

    public function test_homepage_contains_api_documentation(): void
    {
        // Create some test data
        $genre = Genre::factory()->create();
        $director = Director::factory()->create();
        Movie::factory()->create([
            'genre_id' => $genre->id,
            'director_id' => $director->id,
        ]);

        // Visit the homepage
        $response = $this->get(route('home'));

        // Assert the page contains API documentation
        $response->assertSee('GET');
        $response->assertSee('POST');
        $response->assertSee('PUT');
        $response->assertSee('DELETE');
        $response->assertSee('/api/movies');
        $response->assertSee('/api/directors');
        $response->assertSee('/api/genres');
        $response->assertSee('Parameters');
        $response->assertSee('Example Response');
    }
}
