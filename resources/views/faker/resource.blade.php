@extends('layouts.app')

@section('content')
    <div class="relative isolate overflow-hidden bg-white">
        <div class="mx-auto max-w-7xl px-6 pt-10 pb-24 sm:pb-32 lg:flex lg:px-8 lg:py-40">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:shrink-0 lg:pt-8 prose dark:prose-invert ">
                <h1>
                    Generate {{ $resource }}
                </h1>
                <p class="lead">{{ $longDescription }}</p>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-6 pt-10 pb-24 sm:pb-32 lg:flex lg:px-8 lg:py-40">
        <x-faker.resource-usage :resource="$resource" :parameters="$availableParameters"/>
    </div>

@endsection
