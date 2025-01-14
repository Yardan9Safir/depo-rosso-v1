<div class="flex items-center justify-between">
    <h2 class="font-bold text-xl leading-tight">
        <div class="flex items-center space-x-2">
            <h1 class="bg-orange-500 pl-1.5 pr-1.5 rounded-md text-white text-md\">A</h1>
            <h1 class="text-white
                text-2xl">Depo Rosso</h1>
        </div>
    </h2>
    <div class="flex flex-row ml-auto mr-auto space-x-5">
        <div class="text-center">
            <x-nav-link-client :href="route('about')" :active="request()->routeIs('about')">
                <h2 class="font-bold text-xl {{ request()->routeIs('about') }}">
                    {{ __('About Us') }}
                </h2>
                <div class="h-1 {{ request()->routeIs('about') }}">
                </div>
            </x-nav-link-client>
        </div>

        <div class="text-center">
            <x-nav-link-client :href="route('dashboardclient')" :active="request()->routeIs('dashboardclient')">
                <h2 class="font-bold text-xl {{ request()->routeIs('dashboardclient') }}">
                    {{ __('Dashboard') }}
                </h2>
                <div class="h-1 {{ request()->routeIs('dashboardclient') }}">
                </div>
            </x-nav-link-client>
        </div>

        <div class="text-center">
            <x-nav-link-client :href="route('listbarang')" :active="request()->routeIs('listbarang')">
                <h2 class="font-bold text-xl {{ request()->routeIs('listbarang') }}">
                    {{ __('List Barang') }}
                </h2>
                <div class="h-1 {{ request()->routeIs('listbarang') }}">
                </div>
            </x-nav-link-client>
        </div>

    </div>
    <div class="flex flex-col ml-16">
        <x-dropdown-link :href="route('loginclient')">
            {{ __('Login') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('registerclient')">
            {{ __('Register') }}
        </x-dropdown-link>
    </div>
</div>
