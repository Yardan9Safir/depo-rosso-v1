@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-l-lg hover:bg-white/20 focus:outline-none focus:bg-white/20 dark:bg-gray-100 dark:text-black bg-[#F3F4FF] hover:cursor-default'
            : 'flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-l-lg hover:bg-white/20 focus:outline-none focus:bg-white/20 dark:bg-gray-100 dark:text-white-100 dark:bg-neutral-800 text-white hover:cursor-default';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
