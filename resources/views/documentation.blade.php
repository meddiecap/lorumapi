@extends('layouts.app')

@section('content')
<div class="py-12" id="api-docs">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">API Documentation</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Welcome to the Lorem Ipsum API, a comprehensive RESTful API that provides rich, structured data for movies, directors, and genres.
                Whether you're building a movie recommendation app, a cinema booking system, or just need realistic data for testing, our API has you covered.
            </p>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                All API endpoints are accessible at <code class="bg-gray-100 dark:bg-gray-700 px-1 py-0.5 rounded">/api</code>.
                The API returns JSON responses and uses standard HTTP status codes to indicate the success or failure of requests.
            </p>
            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Getting Started</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    To get started, you can use any HTTP client like cURL, Postman, or Axios to make requests to the API endpoints.
                    No authentication is required for this demo API, making it perfect for quick prototyping and learning.
                </p>
                <x-code-block language="bash" title="Example cURL Request">
curl -X GET "{{ url('/api/movies') }}" -H "Accept: application/json"
                </x-code-block>
                <x-code-block language="javascript" title="Example JavaScript Request">
// Using Fetch API
fetch('{{ url('/api/movies') }}', {
  headers: {
    'Accept': 'application/json'
  }
})
.then(response => response.json())
.then(data => console.log(data));

// Using Axios
axios.get('{{ url('/api/movies') }}', {
  headers: {
    'Accept': 'application/json'
  }
})
.then(response => console.log(response.data));
                </x-code-block>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">API Endpoints</h2>

        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Movies</h3>

        <x-api-endpoint
            method="GET"
            endpoint="/api/movies"
            description="Returns a paginated list of movies. The list can be filtered and sorted."
            :parameters="[
                ['name' => 'title', 'type' => 'string', 'description' => 'Filter movies by title', 'required' => false],
                ['name' => 'release_year', 'type' => 'integer', 'description' => 'Filter movies by release year', 'required' => false],
                ['name' => 'rating', 'type' => 'float', 'description' => 'Filter movies by minimum rating', 'required' => false],
                ['name' => 'genre_id', 'type' => 'string', 'description' => 'Filter movies by genre ID', 'required' => false],
                ['name' => 'director_id', 'type' => 'string', 'description' => 'Filter movies by director ID', 'required' => false],
                ['name' => 'sort', 'type' => 'string', 'description' => 'Field to sort by (title, release_year, rating)', 'required' => false],
                ['name' => 'order', 'type' => 'string', 'description' => 'Sort order (asc, desc)', 'required' => false],
                ['name' => 'per_page', 'type' => 'integer', 'description' => 'Number of items per page', 'required' => false],
            ]"
            :response="$movieResource"
        />

        <x-api-endpoint
            method="GET"
            endpoint="/api/movies/{id}"
            description="Returns a single movie by ID."
            :parameters="[
                ['name' => 'id', 'type' => 'string', 'description' => 'The ID of the movie', 'required' => true],
            ]"
            :response="$movieResource"
        />

        <x-api-endpoint
            method="POST"
            endpoint="/api/movies"
            description="Creates a new movie."
            :parameters="[
                ['name' => 'title', 'type' => 'string', 'description' => 'The title of the movie', 'required' => true],
                ['name' => 'description', 'type' => 'string', 'description' => 'The description of the movie', 'required' => true],
                ['name' => 'release_year', 'type' => 'integer', 'description' => 'The release year of the movie', 'required' => true],
                ['name' => 'rating', 'type' => 'float', 'description' => 'The rating of the movie (0-10)', 'required' => true],
                ['name' => 'genre_id', 'type' => 'string', 'description' => 'The ID of the genre', 'required' => true],
                ['name' => 'director_id', 'type' => 'string', 'description' => 'The ID of the director', 'required' => true],
            ]"
            :response="$movieResource"
        />

        <x-api-endpoint
            method="PUT"
            endpoint="/api/movies/{id}"
            description="Updates an existing movie."
            :parameters="[
                ['name' => 'id', 'type' => 'string', 'description' => 'The ID of the movie', 'required' => true],
                ['name' => 'title', 'type' => 'string', 'description' => 'The title of the movie', 'required' => false],
                ['name' => 'description', 'type' => 'string', 'description' => 'The description of the movie', 'required' => false],
                ['name' => 'release_year', 'type' => 'integer', 'description' => 'The release year of the movie', 'required' => false],
                ['name' => 'rating', 'type' => 'float', 'description' => 'The rating of the movie (0-10)', 'required' => false],
                ['name' => 'genre_id', 'type' => 'string', 'description' => 'The ID of the genre', 'required' => false],
                ['name' => 'director_id', 'type' => 'string', 'description' => 'The ID of the director', 'required' => false],
            ]"
            :response="$movieResource"
        />

        <x-api-endpoint
            method="DELETE"
            endpoint="/api/movies/{id}"
            description="Deletes a movie."
            :parameters="[
                ['name' => 'id', 'type' => 'string', 'description' => 'The ID of the movie', 'required' => true],
            ]"
        />

        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 mt-8">Directors</h3>

        <x-api-endpoint
            method="GET"
            endpoint="/api/directors"
            description="Returns a paginated list of directors. The list can be filtered and sorted."
            :parameters="[
                ['name' => 'name', 'type' => 'string', 'description' => 'Filter directors by name', 'required' => false],
                ['name' => 'birth_date', 'type' => 'date', 'description' => 'Filter directors by birth date (YYYY-MM-DD)', 'required' => false],
                ['name' => 'sort', 'type' => 'string', 'description' => 'Field to sort by (name, birth_date)', 'required' => false],
                ['name' => 'order', 'type' => 'string', 'description' => 'Sort order (asc, desc)', 'required' => false],
                ['name' => 'per_page', 'type' => 'integer', 'description' => 'Number of items per page', 'required' => false],
            ]"
            :response="$directorsCollection"
        />

        <x-api-endpoint
            method="GET"
            endpoint="/api/directors/{id}"
            description="Returns a single director by ID."
            :parameters="[
                ['name' => 'id', 'type' => 'string', 'description' => 'The ID of the director', 'required' => true],
            ]"
            :response="$directorResource"
        />

        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 mt-8">Genres</h3>

        <x-api-endpoint
            method="GET"
            endpoint="/api/genres"
            description="Returns a paginated list of genres. The list can be filtered and sorted."
            :parameters="[
                ['name' => 'name', 'type' => 'string', 'description' => 'Filter genres by name', 'required' => false],
                ['name' => 'sort', 'type' => 'string', 'description' => 'Field to sort by (name)', 'required' => false],
                ['name' => 'order', 'type' => 'string', 'description' => 'Sort order (asc, desc)', 'required' => false],
                ['name' => 'per_page', 'type' => 'integer', 'description' => 'Number of items per page', 'required' => false],
            ]"
        />

        <x-api-endpoint
            method="GET"
            endpoint="/api/genres/{id}"
            description="Returns a single genre by ID."
            :parameters="[
                ['name' => 'id', 'type' => 'string', 'description' => 'The ID of the genre', 'required' => true],
            ]"
            :response="$genreResource"
        />
    </div>
</div>
@endsection
