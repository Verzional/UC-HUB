<x-app-layout>
    {{-- Nav Bar ICE --}}
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

    <div x-data="{ tab: 'companies', openCompanyModal: false, openJobModal: false }" class="flex h-full min-h-screen bg-gray-50">

        {{-- Sidebar --}}
        <div class="w-40 border-r border-gray-200 p-4 flex flex-col space-y-2 bg-white">
            <button
                @click="tab = 'companies'"
                :class="tab === 'companies' ? 'font-bold text-orange-600' : 'text-gray-700'"
                class="block w-full text-left px-2 py-1 rounded hover:bg-gray-100 transition"
            >
                Companies
            </button>
            <button
                @click="tab = 'jobs'"
                :class="tab === 'jobs' ? 'font-bold text-orange-600' : 'text-gray-700'"
                class="block w-full text-left px-2 py-1 rounded hover:bg-gray-100 transition"
            >
                Jobs
            </button>
            <button
                @click="tab = 'surveys'"
                :class="tab === 'surveys' ? 'font-bold text-orange-600' : 'text-gray-700'"
                class="block w-full text-left px-2 py-1 rounded hover:bg-gray-100 transition"
            >
                Surveys
            </button>
        </div>

        {{-- Main Content --}}
        <div class="flex-1 p-6 overflow-y-auto">

           {{-- Companies Tab --}}
<div x-show="tab === 'companies'" x-transition>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Companies</h2>
        <button
            @click="openCompanyModal = true"
            class="rounded bg-orange-500 px-4 py-2 text-white hover:bg-orange-700 transition"
        >
            + Create Company
        </button>
    </div>

    {{-- Top Survey Companies --}}
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Top Survey Companies</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        @forelse($topSurveyCompanies ?? [] as $company)
            @include('main.ice.partials.company-card', ['company' => $company, 'isTop' => true])
        @empty
            <p class="text-gray-500 col-span-3">No top survey companies.</p>
        @endforelse
    </div>

    {{-- All Companies --}}
    <h3 class="text-lg font-semibold text-gray-700 mb-2">All Companies</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($allCompanies ?? [] as $company)
            @include('main.ice.partials.company-card', ['company' => $company, 'isTop' => false])
        @empty
            <p class="text-gray-500 col-span-3">No companies found.</p>
        @endforelse
    </div>
</div>


            {{-- Jobs Tab --}}
            <div x-show="tab === 'jobs'" x-transition>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Jobs</h2>
                    <button
                        @click="openJobModal = true"
                        class="rounded bg-orange-500 px-4 py-2 text-white hover:bg-orange-700 transition"
                    >
                        + Create Job
                    </button>
                </div>

                {{-- Grid Jobs --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($jobs ?? [] as $job)
                        <div class="rounded-lg bg-white p-5 shadow hover:shadow-lg transition">
                            <h4 class="font-semibold text-gray-800">{{ $job->title }}</h4>
                            <p class="text-sm text-gray-500">{{ $job->company->name ?? 'No company' }}</p>
                            <p class="text-sm text-gray-600 line-clamp-3">{{ $job->description ?? 'No description' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3">No jobs found.</p>
                    @endforelse
                </div>
            </div>

            {{-- Surveys Tab --}}
            <div x-show="tab === 'surveys'" x-transition>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Surveys</h2>

                @if($surveys->isEmpty())
                    <p class="text-gray-500">No surveys available.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($surveys as $survey)
                            <div class="rounded-lg bg-white p-5 shadow hover:shadow-lg transition">
                                <h4 class="font-semibold text-gray-800">
                                    {{ $survey->user->name ?? 'Unknown Student' }}
                                </h4>
                                <p class="text-sm text-gray-500">
                                    Primary Interest: {{ $survey->primary_interest ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    CGPA: {{ $survey->cgpa ?? 'N/A' }}
                                </p>

                                @if($survey->wishlists->isNotEmpty())
                                    <p class="text-sm mt-2 font-medium text-gray-600">Wishlist Companies:</p>
                                    <ul class="list-disc list-inside text-sm text-gray-500">
                                        @foreach($survey->wishlists as $wishlist)
                                            <li>{{ $wishlist->company_name ?? 'N/A' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-gray-400 mt-2">No wishlist companies.</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        {{-- Modals --}}
        <div>

            {{-- Create Company Modal --}}
            <div
                x-show="openCompanyModal"
                x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div @click.away="openCompanyModal = false" class="bg-white rounded-lg w-full max-w-lg p-6 overflow-y-auto max-h-[90vh]">
                    <h2 class="text-xl font-semibold mb-4">Create Company</h2>
                    {{-- Include form without nav bar --}}
                    @include('main.companies.create')
                </div>
            </div>

            {{-- Create Job Modal --}}
            <div
                x-show="openJobModal"
                x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div @click.away="openJobModal = false" class="bg-white rounded-lg w-full max-w-lg p-6 overflow-y-auto max-h-[90vh]">
                    <h2 class="text-xl font-semibold mb-4">Create Job</h2>
                    {{-- Include form without nav bar --}}
                    @include('main.jobs.create', ['companies' => $allCompanies, 'skills' => $skills])
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
