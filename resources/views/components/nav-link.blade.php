@props(['active' => false])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center text-green-700 dark:text-green-400 font-semibold bg-green-100 dark:bg-green-900/30'
    : 'inline-flex items-center text-gray-700 dark:text-gray-300 hover:text-green-700 dark:hover:text-green-400 hover:bg-gray-100 dark:hover:bg-gray-800';
@endphp

<a {{ $attributes->merge(['class' => $classes . ' transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>