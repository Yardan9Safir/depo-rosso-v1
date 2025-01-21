<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan') }}
            </h2>
            <div class="flex flex-col ml-auto">
                <x-dropdown-link :href="route('laporan.edit')">
                    {{ __('Admin Profile') }}
                </x-dropdown-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="flex h-screen">
    </div>
</x-app-layout>
