<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
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
                        Pengguna
                    </h2>
                    <p class="text-sm text-gray-600">
                        Edit Pengguna
                    </p>
                </div>

                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                        <div class="sm:col-span-3">
                            <label class="inline-block text-sm text-gray-800 mt-2.5">
                                Foto Profil
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="flex items-center gap-5">
                                <div class="flex gap-x-2">
                                    <img class="inline-block size-16 rounded-full ring-2 ring-white dark:ring-neutral-900"
                                        src="{{ asset('storage/images/' . $user->photo_profile) }}"
                                        alt="Gambar Barang">
                                    <div>
                                        <input name="photo_profile" type="file"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50">
                                        </input>
                                    </div>
                                </div>
                                @error('photo_profile')
                                    <x-input-error :messages="$errors->get('photo_profile')" class="mt-2" />
                                @enderror
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="af-account-full-name" class="inline-block text-sm text-gray-800 mt-2.5">
                                Nama
                            </label>
                            <div class="hs-tooltip inline-block">
                                <svg class="hs-tooltip-toggle ms-1 inline-block size-3 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                                <span
                                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible w-40 text-center z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm"
                                    role="tooltip">
                                    Displayed on public forums, such as Preline
                                </span>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input id="af-account-full-name" type="text" name="name"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                    placeholder="Septian" value="{{ old('name', $user->name) }}">
                            </div>
                            @error('name')
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="af-account-bio" class="inline-block text-sm text-gray-800 mt-2.5">
                                Email
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <input id="af-account-bio" name="email"
                                class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                placeholder="jawahitam@gmail.com" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5">
                                Alamat
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="space-y-2">
                                <input id="af-account-password" type="text" name="address"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                    placeholder="Surabaya" value="{{ old('address', $user->address) }}">
                            </div>
                            @error('address')
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5">
                                Password
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="space-y-2">
                                <input id="af-account-password" type="password" name="password"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ old('password', $user->password) }}">
                            </div>
                            @error('password')
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            @enderror
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Grid -->

                    <div class="mt-5 flex justify-end gap-x-2">
                        <a href="{{ route('users.index') }}" type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-800 dark:text-black-300 dark:hover:bg-neutral-300 dark:focus:bg-neutral-300">
                            Cancel
                        </a>

                        <button type="submit"
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
