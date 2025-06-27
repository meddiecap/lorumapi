@props(['language' => 'json', 'title' => null])

<div {{ $attributes->merge(['class' => 'overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6']) }}>
    @if($title)
        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $title }}</h3>
        </div>
    @endif
    <div class="p-1 bg-gray-800 dark:bg-gray-900 overflow-x-auto">
        <pre class="language-{{ $language }} p-4 text-sm text-white overflow-auto"><code>{{ $slot }}</code></pre>
    </div>
</div>
