@props(['title', 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'py-12 bg-gray-100 dark:bg-gray-900']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                {{ $title }}
            </h2>
            @if($subtitle)
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 dark:text-gray-400">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        <div class="mt-10">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
