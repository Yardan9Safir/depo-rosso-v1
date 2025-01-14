<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Depo Air Rosso') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow px-2 ml-64">
                <div class="max-w-7xl mx-auto py-6 px-2 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <div class="bg-gray-200 w-64">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <main class="flex-1 p-4">
                {{-- alert --}}
                @if (session('success'))
                    <div id="success-message" class="mt-2 bg-teal-500 text-sm text-white rounded-lg p-4" role="alert"
                        tabindex="-1" aria-labelledby="hs-solid-color-success-label">
                        {{ session('success') }}
                        <button onclick="document.getElementById('success-message').style.display='none'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="size-4">
                                <path fill-rule="evenodd"
                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm2.78-4.22a.75.75 0 0 1-1.06 0L8 9.06l-1.72 1.72a.75.75 0 1 1-1.06-1.06L6.94 8 5.22 6.28a.75.75 0 0 1 1.06-1.06L8 6.94l1.72-1.72a.75.75 0 1 1 1.06 1.06L9.06 8l1.72 1.72a.75.75 0 0 1 0 1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @else
                @endif

                {{-- end alert --}}

                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
