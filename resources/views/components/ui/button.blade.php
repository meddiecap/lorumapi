@props([
    'type' => 'primary', // primary, secondary, arrow
    'size' => 'large',   // small, normal, large
    'url' => null,
    'buttonType' => 'submit'
])

@php
    $classes = 'btn btn-' . $type . ' btn-' . $size;
@endphp

@if ($url)
    <a href="{{ $url }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if ($type === 'arrow')
            <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        @endif
    </a>
@else
    <button type="{{ $buttonType }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if ($type === 'arrow')
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        @endif
    </button>
@endif
