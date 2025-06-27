@props(['icon', 'title', 'description'])

<div {{ $attributes->merge(['class' => 'p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300']) }}>
    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 dark:bg-indigo-600 text-white">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
        </svg>
    </div>
    <h3 class="mt-5 text-lg font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
    <p class="mt-2 text-base text-gray-500 dark:text-gray-400">
        {{ $description }}
    </p>
    @if($slot->isNotEmpty())
        <div class="mt-4">
            {{ $slot }}
        </div>
    @endif
</div>
