<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow p-6 space-y-6">

        <h2 class="text-2xl font-bold text-orange-600 text-center">Create Job</h2>

        <form method="POST" action="{{ route('jobs.store') }}" class="space-y-4">
            @csrf

            {{-- Title --}}
            <div class="bg-white rounded-lg shadow p-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Description --}}
            <div class="bg-white rounded-lg shadow p-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Location --}}
            <div class="bg-white rounded-lg shadow p-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Company Autocomplete --}}
            <div class="bg-white rounded-lg shadow p-4" x-data="{
                companies: @js($companies->toArray()),
                selectedCompany: @js(old('company_id', '')),
                searchCompany: '',
                openCompany: false,
                init() {
                    if (this.selectedCompany) {
                        const company = this.companies.find(c => c.id == this.selectedCompany)
                        if (company) this.searchCompany = company.name
                    }
                }
            }">
                <label for="company_id" class="block text-sm font-medium text-gray-700">Company</label>
                <div class="relative">
                    <input type="text" x-model="searchCompany" @focus="openCompany = true" @blur="openCompany = false"
                           placeholder="Search and select company..."
                           class="block w-full rounded-md border-gray-300 shadow-sm" required>
                    <ul x-show="openCompany" class="absolute z-10 max-h-60 w-full overflow-y-auto rounded-md border border-gray-300 bg-white shadow-lg">
                        <template x-for="company in companies.filter(c => c.name.toLowerCase().includes(searchCompany.toLowerCase()))" :key="company.id">
                            <li @mousedown.prevent="selectedCompany = company.id; searchCompany = company.name; openCompany = false"
                                class="cursor-pointer px-4 py-2 hover:bg-gray-100" x-text="company.name"></li>
                        </template>
                    </ul>
                </div>
                <input type="hidden" name="company_id" x-model="selectedCompany">
                @error('company_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Employment Type --}}
            <div class="bg-white rounded-lg shadow p-4">
                <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type</label>
                <select name="employment_type" id="employment_type"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Select Type</option>
                    <option value="Full-time" {{ old('employment_type')=='Full-time' ? 'selected':'' }}>Full-time</option>
                    <option value="Part-time" {{ old('employment_type')=='Part-time' ? 'selected':'' }}>Part-time</option>
                    <option value="Contract" {{ old('employment_type')=='Contract' ? 'selected':'' }}>Contract</option>
                    <option value="Internship" {{ old('employment_type')=='Internship' ? 'selected':'' }}>Internship</option>
                </select>
                @error('employment_type') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Salary --}}
            <div class="bg-white rounded-lg shadow p-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                <input type="text" name="salary" id="salary" value="{{ old('salary') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('salary') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Application Deadline --}}
            <div class="bg-white rounded-lg shadow p-4">
                <label for="application_deadline" class="block text-sm font-medium text-gray-700">Application Deadline</label>
                <input type="date" name="application_deadline" id="application_deadline" value="{{ old('application_deadline') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('application_deadline') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Start Time --}}
            <div class="bg-white rounded-lg shadow p-4">
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('start_time') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- End Time --}}
            <div class="bg-white rounded-lg shadow p-4">
                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('end_time') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end space-x-2">
                <a href="{{ route('main.ice.dashboard') }}" class="rounded bg-gray-300 px-4 py-2 font-bold text-gray-800 hover:bg-gray-400 transition">
                    Cancel
                </a>
                <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-bold text-white hover:bg-orange-700 transition">
                    Create Job
                </button>
            </div>
        </form>

    </div>
</div>
