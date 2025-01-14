<div class="flex justify-center mt-4">
    <div class="inline-flex items-center">
        @if ($paginator->onFirstPage())
            <span class="py-2 px-4 text-gray-500 ">Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="py-2 px-4 text-white bg-[#4D44B5] rounded-md dark:focus:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:hover:bg-neutral-700">Prev</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="py-2 px-4 text-gray-500">{{ $element }}</span>
            @elseif (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="py-2 px-4 bg-[#4D44B5] text-white rounded-md dark:focus:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:hover:bg-neutral-700">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="py-2 px-4 text-[#4D44B5] rounded-md dark:text-neutral-700">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="py-2 px-4 text-white bg-[#4D44B5] rounded-md dark:focus:bg-neutral-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:hover:bg-neutral-700">Next</a>
        @else
            <span class="py-2 px-4 text-gray-500">Next</span>
        @endif
    </div>
</div>
