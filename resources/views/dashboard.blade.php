<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex flex-col ml-auto">
                <x-dropdown-link :href="route('profile.edit')">
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
        <!-- Main Content -->
        <div class="flex-1 flex items-left justify-center bg-gray-100">
            <div id="hs-single-area-chart"></div>
        </div>
    </div>
</x-app-layout>
