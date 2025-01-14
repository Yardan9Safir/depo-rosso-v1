<x-client-layout>
    <x-slot name="header">
        @include('clients.partials.navbar')
    </x-slot>

    <div class="flex h-screen">
        <!-- Main Content -->
        <div class="flex-1 flex items-left justify-center bg-gray-100">
            <div class="text-center">
                <h2 class="text-2xl font-semibold">Welcome to the Page</h2>
                <p class="mt-2 text-gray-700">This is the main content area.</p>
            </div>
        </div>
    </div>
</x-client-layout>
