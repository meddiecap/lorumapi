@props(['title', 'subtitle' => null, 'image' => null, 'backgroundImage' => null])

<div {{ $attributes->merge(['class' => 'relative ' . (!$backgroundImage ? 'bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-800 dark:to-purple-800' : '')]) }}
    @if($backgroundImage)
    style="background-image: url('{{ $backgroundImage }}'); background-size: cover; background-position: center;"
    @endif
>
    <!-- Semi-transparent overlay for better text readability when using background image -->
    @if($backgroundImage)
    <div class="absolute inset-0 bg-indigo-900 opacity-60"></div>
    @endif

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 z-10">
        <div class="md:flex md:items-center md:justify-between">
            <div class="md:w-2/3">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight">
                    {{ $title }}
                </h1>
                @if($subtitle)
                    <p class="mt-4 text-xl text-indigo-100 max-w-3xl">
                        {{ $subtitle }}
                    </p>
                @endif
                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
            @if($image)
                <div class="mt-8 md:mt-0 md:w-1/3">
                    <img src="{{ $image }}" alt="Hero image" class="w-full h-auto rounded-lg shadow-xl">
                </div>
            @endif
        </div>
    </div>
</div>
