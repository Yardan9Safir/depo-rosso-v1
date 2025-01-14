<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Orders') }}
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
        <!-- Card Section -->
        <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7">
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800">
                        Pesanan
                    </h2>
                    <p class="text-sm text-gray-600">
                        Tambahkan Pesanan
                    </p>
                </div>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <!-- Grid -->
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                        <div class="sm:col-span-3">
                            <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5">
                                Client ID
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <select name="items_id"
                                class="py-2 px-3 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Client</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->client_id }}"></option>
                                @endforeach
                            </select>
                            {{-- <input id="af-account-bio" name="users_id"
                                class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                placeholder="1" type="number"></input> --}}
                            @error('client_id')
                                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5">
                                Items Id
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            {{-- <input id="af-account-bio" name="items_id"
                                class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                placeholder="1" type="number"></input> --}}
                            <select name="items_id"
                                class="py-2 px-3 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Item</option>
                                @foreach ($orders as $order)
                                    <option>{{ $order->items_id }}</option>
                                @endforeach
                            </select>
                            @error('items_id')
                                <x-input-error :messages="$errors->get('items_id')" class="mt-2" />
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="af-account-bio" class="inline-block text-sm text-gray-800 mt-2.5">
                                Jumlah Barang
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <input id="af-account-bio" name="quantity"
                                class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                placeholder="15" type="number"></input>
                            @error('quantity')
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5">
                                Total Harga Barang
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <input id="af-account-bio" name="total_price"
                                class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                placeholder="15" type="number"></input>
                            @error('total_price')
                                <x-input-error :messages="$errors->get('total_price')" class="mt-2" />
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5">
                                Status
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9" name="status">
                            <select name="status"
                                class="py-2 px-3 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="pending" selected>Pending</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>
                            </select>
                            {{-- <input id="af-account-bio" name="status"
                                class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                placeholder="1" type="text"></input> --}}
                            @error('status')
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            @enderror
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Grid -->

                    <div class="mt-5 flex justify-end gap-x-2">
                        <a href="{{ route('orders.index') }}" type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-800 dark:text-black-300 dark:hover:bg-neutral-300 dark:focus:bg-neutral-300">
                            Cancel
                        </a>

                        <button
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#4D44B5] text-white hover:bg-blue-900 dark:bg-black dark:hover:bg-neutral-700 focus:outline-none focus:bg-blue-900 dark:focus:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Card Section -->
    </div>
</x-app-layout>
