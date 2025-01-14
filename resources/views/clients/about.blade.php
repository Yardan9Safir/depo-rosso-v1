<x-client-layout>
    <x-slot name="header">
        @include('clients.partials.navbar')
    </x-slot>

    <div class="h-screen">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Column 1 -->
            <div class="flex items-center gap-x-3">
                <!-- Content for Column 1 -->
            </div>

            <!-- Column 2 -->
            <div>
                <!-- Content for Column 2 -->
            </div>
        </div>
    </div>
</x-client-layout>
