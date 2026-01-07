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
            <div class="mb-6 flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-400 text-white">
                    👤
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-800">Welcome!</p>
                    <p class="text-sm text-gray-500">
                        Manage companies and job opportunities
                    </p>
                </div>
            </div>

            {{-- Company List --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Dummy data (UI only) --}}
                @php
                    $companies = [
                        [
                            'name' => 'PT Teknologi Nusantara',
                            'industry' => 'Technology',
                            'address' => 'Jakarta',
                        ],
                        [
                            'name' => 'CV Kreatif Digital',
                            'industry' => 'Creative Industry',
                            'address' => 'Bandung',
                        ],
                        [
                            'name' => 'PT Edu Solusi',
                            'industry' => 'Education',
                            'address' => 'Surabaya',
                        ],
                    ];
                @endphp

                @foreach ($companies as $company)
                    @include('main.ice.partials.company-card', ['company' => $company])
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
