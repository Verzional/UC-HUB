<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Create Job
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('jobs.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Title
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            />
                            @error('title')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Description
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            >
{{ old('description') }}</textarea
                            >
                            @error('description')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="location"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Location
                            </label>
                            <input
                                type="text"
                                name="location"
                                id="location"
                                value="{{ old('location') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('location')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="company_id"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Company
                            </label>
                            <select
                                name="company_id"
                                id="company_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            >
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option
                                        value="{{ $company->id }}"
                                        {{ old('company_id') == $company->id ? 'selected' : '' }}
                                    >
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="employment_type"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Employment Type
                            </label>
                            <select
                                name="employment_type"
                                id="employment_type"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >
                                <option value="">Select Type</option>
                                <option
                                    value="Full-time"
                                    {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}
                                >
                                    Full-time
                                </option>
                                <option
                                    value="Part-time"
                                    {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}
                                >
                                    Part-time
                                </option>
                                <option
                                    value="Contract"
                                    {{ old('employment_type') == 'Contract' ? 'selected' : '' }}
                                >
                                    Contract
                                </option>
                                <option
                                    value="Internship"
                                    {{ old('employment_type') == 'Internship' ? 'selected' : '' }}
                                >
                                    Internship
                                </option>
                            </select>
                            @error('employment_type')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="salary"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Salary
                            </label>
                            <input
                                type="number"
                                step="0.01"
                                name="salary"
                                id="salary"
                                value="{{ old('salary') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('salary')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="application_deadline"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Application Deadline
                            </label>
                            <input
                                type="date"
                                name="application_deadline"
                                id="application_deadline"
                                value="{{ old('application_deadline') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('application_deadline')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="start_time"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Start Time
                            </label>
                            <input
                                type="datetime-local"
                                name="start_time"
                                id="start_time"
                                value="{{ old('start_time') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('start_time')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="end_time"
                                class="block text-sm font-medium text-gray-700"
                            >
                                End Time
                            </label>
                            <input
                                type="datetime-local"
                                name="end_time"
                                id="end_time"
                                value="{{ old('end_time') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('end_time')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a
                                href="{{ route('jobs.index') }}"
                                class="mr-2 rounded bg-gray-300 px-4 py-2 font-bold text-gray-800 hover:bg-gray-400"
                            >
                                Cancel
                            </a>
                            <button
                                type="submit"
                                class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                            >
                                Create Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
