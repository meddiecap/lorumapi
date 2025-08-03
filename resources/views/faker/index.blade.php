@extends('layouts.app')

@section('content')
    <div class="relative isolate overflow-hidden bg-white">
        <div class="mx-auto max-w-7xl px-6 pt-10 pb-24 sm:pb-32 lg:flex lg:px-8 lg:py-40">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:shrink-0 lg:pt-8">

                <h1 class="mt-10 text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-7xl">
                    Generate mock data for testing with the Faker API
                </h1>
                <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">
                    A collection of endpoints that makes it easy to create random JSON content.
                    This is the official Lorum API site, and it's completely free to use.
                </p>
                <div class="mt-10 flex items-center gap-x-6">
                    <x-ui.button  type="primary" size="large" :url="route('documentation')">Get started</x-ui.button>
                    <x-ui.button  type="arrow" size="large" url="#">Learn more</x-ui.button>
                </div>
            </div>
            <div
                class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:mt-0 lg:mr-0 lg:ml-10 lg:max-w-none lg:flex-none xl:ml-32">
                <div class="max-w-3xl flex-none sm:max-w-5xl">
                    <div
                        class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-gray-900/10 ring-inset lg:-m-4 lg:rounded-2xl lg:p-4">
                        <img width="2432" height="1442"
                             src="https://tailwindcss.com/plus-assets/img/component-images/project-app-screenshot.png"
                             alt="App screenshot"
                             class="w-304 rounded-md bg-gray-50 shadow-xl ring-1 ring-gray-900/10"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-6 pt-10 pb-24 sm:pb-32 lg:flex lg:px-8 lg:py-40">
        <x-faker.basic-usage :commonParameters="$commonParameters"/>
    </div>

    <div class="mx-auto max-w-7xl px-6 pt-10 pb-24 sm:pb-32 lg:px-8 lg:py-40">
        <h2 class="text-3xl font-semibold text-primary">Available resources</h2>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 pt-10">
            @foreach($fakerResources as $fakerResource)
                <a href="{{ $fakerResource['url'] }}" class="flex flex-col space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-xs focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                    <h3 class="text-base font-semibold text-gray-900">
                        <!-- Extend touch target to entire panel -->
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        {{ $fakerResource['name'] }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">{{ $fakerResource['description'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
@endsection
