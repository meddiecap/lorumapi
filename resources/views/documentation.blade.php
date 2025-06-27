@extends('layouts.app')

@section('content')
<div class="py-12" id="api-docs">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">API Documentation</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Welcome to the {{ $apiSpec['info']['title'] ?? 'API' }} (v{{ $apiSpec['info']['version'] ?? '1.0' }}), a comprehensive RESTful API that provides rich, structured data for movies, directors, and genres.
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

        @foreach($endpoints as $tag => $tagEndpoints)
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ $tag }}</h3>

            @foreach($tagEndpoints as $endpoint)
                <x-api-endpoint
                    method="{{ $endpoint['method'] }}"
                    endpoint="{{ $endpoint['path'] }}"
                    description="{{ $endpoint['description'] }}"
                    :parameters="$endpoint['parameters']"
                    :response="$endpoint['method'] === 'GET' && str_contains($endpoint['path'], 'movies') && !str_contains($endpoint['path'], '{id}') ? $movieResource :
                              ($endpoint['method'] === 'GET' && str_contains($endpoint['path'], 'movies') ? $movieResource :
                              ($endpoint['method'] === 'GET' && str_contains($endpoint['path'], 'directors') && !str_contains($endpoint['path'], '{id}') ? $directorsCollection :
                              ($endpoint['method'] === 'GET' && str_contains($endpoint['path'], 'directors') ? $directorResource :
                              ($endpoint['method'] === 'GET' && str_contains($endpoint['path'], 'genres') ? $genreResource : null))))"
                />
            @endforeach
        @endforeach
    </div>
</div>
@endsection
