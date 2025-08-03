@extends('layouts.app')

@section('content')
<x-hero-header
    title="Lorem Ipsum API"
    subtitle="A powerful, developer-friendly RESTful API for testing and prototyping applications with realistic data."
    backgroundImage="https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80">
    <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
        <x-ui.button :url="route('documentation')">View Documentation</x-ui.button>
        <x-ui.button :url="route('documentation')" type="secondary">Try the API</x-ui.button>
        <x-ui.button :url="route('documentation')" type="arrow">Try the API</x-ui.button>
    </div>
</x-hero-header>

<x-usp-section
    title="Why Use Our API?"
    subtitle="Lorem Ipsum API provides everything you need to build and test your applications with realistic data.">
    <x-usp-item
        icon="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
        title="Easy to Use"
        description="Simple, intuitive endpoints with comprehensive documentation make integration a breeze for developers of all skill levels.">
    </x-usp-item>
    <x-usp-item
        icon="M13 10V3L4 14h7v7l9-11h-7z"
        title="Lightning Fast"
        description="Optimized for performance with quick response times, ensuring your development process stays smooth and efficient.">
    </x-usp-item>
    <x-usp-item
        icon="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
        title="Realistic Data"
        description="Access to a comprehensive database of movies, directors, and genres that mimics real-world relationships and structures.">
    </x-usp-item>
</x-usp-section>
@endsection
