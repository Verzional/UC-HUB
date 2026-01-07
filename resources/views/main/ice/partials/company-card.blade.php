<div class="rounded-lg bg-white p-5 shadow transition hover:shadow-lg relative max-w-sm w-full mx-auto">

    {{-- Top Survey Badge --}}
    @if($isTop ?? false)
        <span class="absolute top-2 right-2 bg-orange-500 text-white text-xs px-2 py-1 rounded">
            Top Survey
        </span>
    @endif

    <div class="mb-3 flex items-center gap-3">
        <div class="flex h-10 w-10 items-center justify-center rounded bg-orange-100 text-orange-600 font-bold">
            {{ strtoupper(substr($company?->name ?? '?', 0, 1)) }}
        </div>
        <div>
            <h4 class="font-semibold text-gray-800">{{ $company?->name ?? 'No Name' }}</h4>
            <p class="text-sm text-gray-500">{{ $company?->industry ?? 'Industry not set' }}</p>
        </div>
    </div>

    <p class="mb-4 text-sm text-gray-600 line-clamp-3">
        {{ $company?->description ?? 'No description available.' }}
    </p>

    <div class="flex items-center justify-between">
        <span class="text-xs text-gray-500">
            📍 {{ $company?->address ?? 'Unknown location' }}
        </span>

        @if($company)
            <a href="#" class="text-sm font-medium text-orange-600 hover:underline">
                View →
            </a>
        @else
            <span class="text-sm text-gray-400">No link</span>
        @endif
    </div>
</div>
