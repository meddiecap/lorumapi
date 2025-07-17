<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lorem Ipsum API - A dummy data API for developers">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lorem Ipsum API') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @php
        $viteUrl = env('VITE_URL', '');
    @endphp
    @if($viteUrl)
        <script type="module" src="{{ $viteUrl }}/@vite/client"></script>
        <script type="module" src="{{ $viteUrl }}/resources/js/app.js"></script>
        <link rel="stylesheet" href="{{ $viteUrl }}/resources/css/app.css" />
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                            {{ config('app.name', 'Lorem Ipsum API') }}
                        </a>
                    </div>
                    <!-- Desktop Navigation -->
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 nav-link home-link {{ request()->routeIs('home') ? 'border-indigo-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }}">
                            Home
                        </a>
                        <a href="{{ route('documentation') }}" class="inline-flex items-center px-1 pt-1 border-b-2 nav-link docs-link {{ request()->routeIs('documentation') ? 'border-indigo-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }}">
                            Documentation
                        </a>
                        <a href="{{ url('/api/faker') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700">
                            Faker API
                        </a>
                        <a href="{{ url('/api/movies') }}" target="_blank" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700">
                            Movies API
                        </a>
                        <a href="{{ url('/api/directors') }}" target="_blank" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700">
                            Directors API
                        </a>
                        <a href="{{ url('/api/genres') }}" target="_blank" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700">
                            Genres API
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <!-- Icon when menu is closed -->
                            <svg id="menu-closed-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!-- Icon when menu is open -->
                            <svg id="menu-open-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <a href="https://github.com/your-repo/lorumapi" target="_blank" rel="noopener noreferrer" class="ml-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300" aria-label="GitHub repository">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="nav-link home-link {{ request()->routeIs('home') ? 'bg-indigo-50 dark:bg-indigo-900 border-indigo-500 text-indigo-700 dark:text-indigo-300' : 'border-transparent text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 hover:text-gray-700 dark:hover:text-gray-300' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Home
                </a>
                <a href="{{ route('documentation') }}" class="nav-link docs-link {{ request()->routeIs('documentation') ? 'bg-indigo-50 dark:bg-indigo-900 border-indigo-500 text-indigo-700 dark:text-indigo-300' : 'border-transparent text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 hover:text-gray-700 dark:hover:text-gray-300' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Documentation
                </a>
                <a href="{{ url('/api/movies') }}" target="_blank" class="border-transparent text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 hover:text-gray-700 dark:hover:text-gray-300 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Movies API
                </a>
                <a href="{{ url('/api/directors') }}" target="_blank" class="border-transparent text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 hover:text-gray-700 dark:hover:text-gray-300 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Directors API
                </a>
                <a href="{{ url('/api/genres') }}" target="_blank" class="border-transparent text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 hover:text-gray-700 dark:hover:text-gray-300 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Genres API
                </a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white dark:bg-gray-800 shadow mt-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} Lorem Ipsum API. All rights reserved.
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Built with <a href="https://laravel.com" class="text-indigo-600 dark:text-indigo-400 hover:underline">Laravel</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile menu toggle and navigation scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuClosedIcon = document.getElementById('menu-closed-icon');
            const menuOpenIcon = document.getElementById('menu-open-icon');

            // Handle mobile menu toggle
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    // Toggle mobile menu visibility
                    mobileMenu.classList.toggle('hidden');

                    // Toggle menu icons
                    menuClosedIcon.classList.toggle('hidden');
                    menuOpenIcon.classList.toggle('hidden');

                    // Update aria-expanded attribute
                    const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                    mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
                });

                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        menuClosedIcon.classList.remove('hidden');
                        menuOpenIcon.classList.add('hidden');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Handle active navigation link highlighting based on URL fragment
            function updateActiveNavLink() {
                const fragment = window.location.hash;
                const homeLinks = document.querySelectorAll('.nav-link.home-link');
                const docsLinks = document.querySelectorAll('.nav-link.docs-link');

                // Reset all links to inactive state
                homeLinks.forEach(link => {
                    link.classList.remove('border-indigo-500', 'text-gray-900', 'dark:text-white', 'bg-indigo-50', 'dark:bg-indigo-900', 'text-indigo-700', 'dark:text-indigo-300');
                    link.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
                });

                docsLinks.forEach(link => {
                    link.classList.remove('border-indigo-500', 'text-gray-900', 'dark:text-white', 'bg-indigo-50', 'dark:bg-indigo-900', 'text-indigo-700', 'dark:text-indigo-300');
                    link.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
                });

                // Set active link based on fragment
                if (fragment === '#api-docs') {
                    // Activate Documentation links
                    docsLinks.forEach(link => {
                        // For desktop links
                        link.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
                        link.classList.add('border-indigo-500', 'text-gray-900', 'dark:text-white');

                        // For mobile links (additional classes)
                        if (link.classList.contains('block')) {
                            link.classList.add('bg-indigo-50', 'dark:bg-indigo-900', 'text-indigo-700', 'dark:text-indigo-300');
                        }
                    });
                } else {
                    // Activate Home links (default)
                    homeLinks.forEach(link => {
                        // For desktop links
                        link.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
                        link.classList.add('border-indigo-500', 'text-gray-900', 'dark:text-white');

                        // For mobile links (additional classes)
                        if (link.classList.contains('block')) {
                            link.classList.add('bg-indigo-50', 'dark:bg-indigo-900', 'text-indigo-700', 'dark:text-indigo-300');
                        }
                    });
                }
            }

            // Update active link on page load
            updateActiveNavLink();

            // Update active link when hash changes
            window.addEventListener('hashchange', updateActiveNavLink);
        });
    </script>
</body>
</html>
