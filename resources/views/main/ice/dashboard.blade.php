{{-- Dashboard ICE --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                ICE Dashboard
            </h2>

            <span class="rounded-full bg-gray-100 px-4 py-1 text-sm text-gray-600">
                {{ now()->format('l, d M Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Welcome --}}
            <div class="mb-8 flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-500 text-white">
                    ICE
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-800">
                        Welcome back 👋
                    </p>
                    <p class="text-sm text-gray-500">
                        Manage companies and job opportunities
                    </p>
                </div>
            </div>

            {{-- Statistics --}}
            <div class="mb-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-lg bg-white p-5 shadow">
                    <p class="text-sm text-gray-500">Total Companies</p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ $totalCompanies }}
                    </p>
                </div>

                <div class="rounded-lg bg-white p-5 shadow">
                    <p class="text-sm text-gray-500">Total Jobs</p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ $totalJobs }}
                    </p>
                </div>
            </div>

            {{-- Company List --}}
            <div>
                <h3 class="mb-4 text-lg font-semibold text-gray-800">
                    Companies
                </h3>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($companies as $company)
                        @include('main.ice.partials.company-card', [
                            'company' => $company
                        ])
                    @empty
                        <p class="text-gray-500">
                            No companies available.
                        </p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
