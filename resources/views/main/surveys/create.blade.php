<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Complete Your Survey
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('surveys.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label
                                for="primary_interest"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Primary Interest (Industry)
                            </label>
                            <select
                                name="primary_interest"
                                id="primary_interest"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            >
                                <option value="">Select Industry</option>
                                @foreach($industries as $industry)
                                    <option
                                        value="{{ $industry }}"
                                        {{ old('primary_interest') == $industry ? 'selected' : '' }}
                                    >
                                        {{ $industry }}
                                    </option>
                                @endforeach
                            </select>
                            @error('primary_interest')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="cgpa"
                                class="block text-sm font-medium text-gray-700"
                            >
                                CGPA
                            </label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                max="4"
                                name="cgpa"
                                id="cgpa"
                                value="{{ old('cgpa') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            />
                            @error('cgpa')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div
                            class="mb-4"
                            x-data="{
                                allSkills: @js($skills->toArray()),
                                skills: @js(old('skills', ['', '', '', '', ''])),
                                searchSkills: @js(array_fill(0, 5, '')),
                                openSkills: @js(array_fill(0, 5, false)),
                                updateSearchSkill(index) {
                                    if (this.skills[index]) {
                                        const skill = this.allSkills.find((s) => s.id == this.skills[index])
                                        if (skill) {
                                            this.searchSkills[index] =
                                                skill.name + ' (' + skill.industry + ')'
                                        }
                                    }
                                },
                                init() {
                                    for (let i = 0; i < this.skills.length; i++) {
                                        this.updateSearchSkill(i);
                                    }
                                }
                            }"
                        >
                            <label
                                class="block text-sm font-medium text-gray-700"
                            >
                                Skills (Select 5)
                            </label>
                            <template
                                x-for="(skill, index) in skills"
                                :key="index"
                            >
                                <div class="mb-2">
                                    <div class="relative">
                                        <input
                                            type="text"
                                            x-model="searchSkills[index]"
                                            @focus="openSkills[index] = true"
                                            @blur="openSkills[index] = false"
                                            placeholder="Search and select skill..."
                                            class="block w-full rounded-md border-gray-300 shadow-sm"
                                            required
                                        />
                                        <ul
                                            x-show="openSkills[index]"
                                            class="absolute z-10 max-h-60 w-full overflow-y-auto rounded-md border border-gray-300 bg-white shadow-lg"
                                        >
                                            <template
                                                x-for="skillOption in allSkills.filter((s) =>
                                                    s.name.toLowerCase().includes(searchSkills[index].toLowerCase()) ||
                                                    s.industry.toLowerCase().includes(searchSkills[index].toLowerCase())
                                                )"
                                                :key="skillOption.id"
                                            >
                                                <li
                                                    @mousedown.prevent="skills[index] = skillOption.id; searchSkills[index] = skillOption.name + ' (' + skillOption.industry + ')'; openSkills[index] = false"
                                                    class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                                                    x-text="skillOption.name + ' (' + skillOption.industry + ')'"
                                                ></li>
                                            </template>
                                        </ul>
                                    </div>
                                    <input
                                        type="hidden"
                                        :name="'skills[' + index + ']'"
                                        x-model="skills[index]"
                                    />
                                </div>
                            </template>
                            @error('skills')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div
                            class="mb-4"
                            x-data="{
                                companies: @js($companies->toArray()),
                                selectedCompanies: @js(old('companies', [''])),
                                searchCompanies: @js(array_fill(0, count(old('companies', [''])), '')),
                                openCompanies: @js(array_fill(0, count(old('companies', [''])), false)),
                                updateSearchCompany(index) {
                                    if (this.selectedCompanies[index]) {
                                        const company = this.companies.find((c) => c.id == this.selectedCompanies[index])
                                        if (company) {
                                            this.searchCompanies[index] = company.name
                                        }
                                    }
                                },
                                init() {
                                    for (let i = 0; i < this.selectedCompanies.length; i++) {
                                        this.updateSearchCompany(i);
                                    }
                                }
                            }"
                        >
                            <label
                                class="block text-sm font-medium text-gray-700"
                            >
                                Company Wishlists
                            </label>
                            <template
                                x-for="(company, index) in selectedCompanies"
                                :key="index"
                            >
                                <div class="mb-2">
                                    <div class="relative">
                                        <input
                                            type="text"
                                            x-model="searchCompanies[index]"
                                            @focus="openCompanies[index] = true"
                                            @blur="openCompanies[index] = false"
                                            placeholder="Search and select company..."
                                            class="block w-full rounded-md border-gray-300 shadow-sm"
                                        />
                                        <ul
                                            x-show="openCompanies[index]"
                                            class="absolute z-10 max-h-60 w-full overflow-y-auto rounded-md border border-gray-300 bg-white shadow-lg"
                                        >
                                            <template
                                                x-for="companyOption in companies.filter((c) =>
                                                    c.name.toLowerCase().includes(searchCompanies[index].toLowerCase()) ||
                                                    c.industry.toLowerCase().includes(searchCompanies[index].toLowerCase())
                                                )"
                                                :key="companyOption.id"
                                            >
                                                <li
                                                    @mousedown.prevent="selectedCompanies[index] = companyOption.id; searchCompanies[index] = companyOption.name; openCompanies[index] = false"
                                                    class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                                                    x-text="companyOption.name + ' (' + companyOption.industry + ')'"
                                                ></li>
                                            </template>
                                        </ul>
                                    </div>
                                    <input
                                        type="hidden"
                                        :name="'companies[' + index + ']'"
                                        x-model="selectedCompanies[index]"
                                    />
                                    <button
                                        type="button"
                                        @click="selectedCompanies.splice(index, 1); searchCompanies.splice(index, 1); openCompanies.splice(index, 1)"
                                        x-show="selectedCompanies.length > 1"
                                        class="mt-1 rounded bg-red-500 px-2 py-1 text-xs text-white hover:bg-red-700"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </template>
                            <button
                                type="button"
                                @click="selectedCompanies.push(''); searchCompanies.push(''); openCompanies.push(false)"
                                class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-700"
                            >
                                Add Company
                            </button>
                            @error('companies')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <button
                                type="submit"
                                class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                            >
                                Submit Survey
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>