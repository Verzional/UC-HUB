<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">ICE Dashboard</h2>
            <span class="rounded-full bg-gray-100 px-4 py-1 text-sm text-gray-600">{{ now()->format('l, d M Y') }}</span>
        </div>
    </x-slot>

    <div class="flex h-full py-8" x-data="{ tab: 'companies' }">

        {{-- Sidebar kiri --}}
        <div class="w-40 border-r border-gray-200 px-4">
            <ul class="space-y-2">
                <li>
                    <button class="w-full text-left px-2 py-2 rounded hover:bg-gray-100"
                        :class="{ 'bg-gray-100 font-semibold': tab === 'companies' }"
                        x-on:click="tab = 'companies'">
                        Companies
                    </button>
                </li>
                <li>
                    <button class="w-full text-left px-2 py-2 rounded hover:bg-gray-100"
                        :class="{ 'bg-gray-100 font-semibold': tab === 'jobs' }"
                        x-on:click="tab = 'jobs'">
                        Jobs
                    </button>
                </li>
                <li>
                    <button class="w-full text-left px-2 py-2 rounded hover:bg-gray-100"
                        :class="{ 'bg-gray-100 font-semibold': tab === 'surveys' }"
                        x-on:click="tab = 'surveys'">
                        Surveys
                    </button>
                </li>
            </ul>
        </div>

        {{-- Main content --}}
        <div class="flex-1 px-6 space-y-8">

            {{-- Companies Tab --}}
            <div x-show="tab === 'companies'" x-transition>

                {{-- Top Surveyed Companies --}}
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">Top Surveyed Companies</h3>
                    <div class="grid grid-cols-3 gap-4">
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
                    <div class="flex gap-4 overflow-x-auto py-2">
                        @forelse ($allCompanies ?? [] as $company)
                            <div class="flex-shrink-0 w-80">
                                @include('main.ice.partials.company-card', ['company' => $company, 'isTop' => false])
                            </div>
                        @empty
                            <p class="text-gray-500">No companies found.</p>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- Jobs Tab --}}
            <div x-show="tab === 'jobs'" x-transition>
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Jobs</h3>
                <div class="space-y-4">
                    @forelse ($jobs ?? [] as $job)
                        <div class="rounded-lg bg-white p-5 shadow">
                            <h4 class="font-semibold text-gray-800">{{ $job?->title ?? 'No Title' }}</h4>
                            <p class="text-sm text-gray-500">{{ $job?->company?->name ?? 'No Company' }}</p>
                            <p class="text-sm text-gray-600">Location: {{ $job?->location ?? '-' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">No jobs available.</p>
                    @endforelse
                </div>
            </div>

            {{-- Surveys Tab --}}
            <div x-show="tab === 'surveys'" x-transition>
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Surveys</h3>
                <div class="space-y-4">
                    @forelse ($surveys ?? [] as $survey)
                        <div class="rounded-lg bg-white p-5 shadow">
                            <p class="text-sm text-gray-600">
                                Student: {{ $survey->user?->name ?? 'Guest' }} |
                                Primary Interest: {{ $survey->primary_interest ?? '-' }} |
                                CGPA: {{ $survey->cgpa ?? '-' }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">No surveys available.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
