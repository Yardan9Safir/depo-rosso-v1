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
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                            <!-- Header -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Add Users, edit and more.
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#4D44B5] text-white hover:bg-blue-900 focus:outline-none focus:bg-blue-900 dark:focus:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:hover:bg-neutral-700"
                                            href='{{ route('users.create') }}'>
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M5 12h14" />
                                                <path d="M12 5v14" />
                                            </svg>
                                            Add Users
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800">No</span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800">Foto
                                                    Profil</span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800">Nama
                                                    User</span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800">Email
                                                </span>
                                            </div>
                                        </th>
                                        {{-- <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800">Password</span>
                                            </div>
                                        </th> --}}
                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800">Action</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($users as $index => $client)
                                        <tr>
                                            <td class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-black-800">{{ $index + $users->firstItem() }}</span>
                                            </td>
                                            <td class="px-6 py-3">
                                                <img class="text-center h-16 w-16 rounded-full mx-auto"
                                                    src="{{ asset('storage/public/images/' . $client->photo_profile) }}"
                                                    alt="Gambar Barang">
                                            </td>
                                            <td class="px-6 py-3">
                                                <div class="flex items-center gap-x-3">
                                                    <div>
                                                        <span
                                                            class="block text-sm font-semibold text-black-800">{{ $client->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-black-800">{{ $client->email }}</span>
                                            </td>
                                            {{-- <td class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-black-800">{{ $client->password }}</span>
                                            </td> --}}
                                            <td class="px-2.5 py-2">
                                                <div class="flex items-left">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('users.edit', $client->id) }}"
                                                        class="text-green-800 hover:text-green-600 transition p-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                            fill="currentColor" class="w-5 h-5">
                                                            <path
                                                                d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                                            <path
                                                                d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                                                        </svg>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('users.destroy', $client->id) }}"
                                                        method="post" onsubmit="return confirm('kamu yakin dek?')"
                                                        class="inline-block">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-red-800 hover:text-red-600 transition p-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                                fill="currentColor" class="w-5 h-5">
                                                                <path fill-rule="evenodd"
                                                                    d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Footer -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold text-gray-800">{{ $users->total() }}</span> results
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <div>
                                            {{ $users->onFirstPage('vendor.pagination.depoRosso-default') ? '' : '' }}
                                        </div>
                                        <!-- Pagination Links -->
                                        <div class="inline-flex items-center gap-x-2 text-sm font-medium">
                                            {{ $users->links('vendor.pagination.depoRosso-default') }}
                                        </div>
                                        <div>
                                            {{ $users->hasMorePages('vendor.pagination.depoRosso-default') ? '' : '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Footer -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</x-app-layout>
