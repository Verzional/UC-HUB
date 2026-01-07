<div class="rounded-lg bg-white p-5 shadow transition hover:shadow-lg">
    <div class="mb-3 flex items-center gap-3">
        <div class="flex h-10 w-10 items-center justify-center rounded bg-orange-100 text-orange-600 font-bold">
            {{ strtoupper(substr($company->name, 0, 1)) }}
        </div>
        <div>
            <h4 class="font-semibold text-gray-800">
                {{ $company->name }}
            </h4>
            <p class="text-sm text-gray-500">
                {{ $company->industry ?? 'Industry not set' }}
            </p>
        </div>
    </div>

    <p class="mb-4 text-sm text-gray-600 line-clamp-3">
        {{ $company->description ?? 'No description available.' }}
    </p>

    <div class="flex items-center justify-between">
        <span class="text-xs text-gray-500">
            📍 {{ $company->address ?? 'Unknown location' }}
        </span>

        <a
            href="{{ route('companies.show', $company) }}"
            class="text-sm font-medium text-orange-600 hover:underline"
        >
            View →
        </a>
    </div>
</div>
