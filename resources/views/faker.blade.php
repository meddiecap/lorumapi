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
                    <a href="#"
                       class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                        started</a>
                    <a href="#" class="text-sm/6 font-semibold text-gray-900">Learn more <span
                            aria-hidden="true">→</span></a>
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
        <x-faker.basic-usage :optionalParameters="$optionalParameters"/>
    </div>
@endsection
