@props(['language' => 'json', 'title' => null])

<div data-code-block {{ $attributes->merge(['class' => 'overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6']) }}>
    <div class="flex min-h-[calc(--spacing(12)+1px)] flex-wrap justify-between gap-x-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-500 px-4 dark:border-gray-600">
        @if($title)
            <div class="py-3">
                <h3 class="font-medium text-gray-700 dark:text-gray-300">{{ $title }}</h3>
            </div>
        @endif
    </div>

    <div class="p-1 overflow-x-auto text-xs leading-4">
        <pre data-language="{{ $language }}" class="language-{{ $language }}"><code>{{ $slot }}</code></pre>
    </div>
</div>
