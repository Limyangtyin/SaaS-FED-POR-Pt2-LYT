@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1
                   border-b-2 border-blue-400 dark:border-blue-600 hover:border-blue-500
                   text-sm font-medium leading-5 text-gray-200 dark:text-gray-400
                   focus:outline-none focus:border-blue-700 transition duration-300 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5
                   text-gray-300 dark:text-gray-500 hover:text-gray-100 dark:hover:text-gray-200 hover:border-blue-600
                   dark:hover:border-blue-600 focus:outline-none focus:text-gray-200 dark:focus:text-gray-300
                   focus:border-gray-200 dark:focus:border-gray-300 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
