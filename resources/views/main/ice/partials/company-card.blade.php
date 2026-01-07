{{-- Companies Tab --}}
<div x-show="tab === 'companies'" x-transition>

    {{-- Top Surveyed Companies --}}
    <div>
        <h3 class="mb-4 text-lg font-semibold text-gray-800">Top Surveyed Companies</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($topSurveyedCompanies ?? [] as $company)
                @include('main.ice.partials.company-card', ['company' => $company, 'isTop' => true])
            @empty
                <p class="text-gray-500 col-span-3">No top surveyed companies available.</p>
            @endforelse
        </div>
    </div>

    {{-- All Companies --}}
    <div class="mt-8">
        <h3 class="mb-4 text-lg font-semibold text-gray-800">All Companies</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($allCompanies ?? [] as $company)
                @include('main.ice.partials.company-card', ['company' => $company, 'isTop' => false])
            @empty
                <p class="text-gray-500 col-span-3">No companies found.</p>
            @endforelse
        </div>
    </div>

</div>
