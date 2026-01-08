@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-center gap-2 select-none">

        {{-- TOMBOL PREVIOUS (<) --}}
        @if ($paginator->onFirstPage())
            <span
                class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-100 bg-gray-50 text-gray-300 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-200 bg-white text-uc-grey hover:border-uc-orange hover:text-uc-orange transition duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        @endif

        {{-- LOOPING ANGKA & TITIK-TITIK --}}
        @foreach ($elements as $element)
            {{-- SEPARATOR TITIK-TITIK (...) --}}
            @if (is_string($element))
                <span class="flex items-center justify-center w-10 h-10 text-gray-400 font-bold">
                    {{ $element }}
                </span>
            @endif

            {{-- ARRAY LINK ANGKA --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- ANGKA AKTIF (Orange Gradient) --}}
                        <span
                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-uc-gradient text-white font-bold shadow-md border border-transparent">
                            {{ $page }}
                        </span>
                    @else
                        {{-- ANGKA BIASA (Putih) --}}
                        <a href="{{ $url }}"
                            class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-200 bg-white text-uc-grey hover:border-uc-orange hover:text-uc-orange hover:bg-orange-50 transition duration-200 font-medium">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- TOMBOL NEXT (>) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-200 bg-white text-uc-grey hover:border-uc-orange hover:text-uc-orange transition duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @else
            <span
                class="flex items-center justify-center w-10 h-10 rounded-lg border border-gray-100 bg-gray-50 text-gray-300 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </span>
        @endif
    </nav>
@endif
