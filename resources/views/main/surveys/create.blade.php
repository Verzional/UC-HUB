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
                                <option value="Technology" {{ old('primary_interest') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                <option value="Finance" {{ old('primary_interest') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                <option value="Healthcare" {{ old('primary_interest') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                <option value="Education" {{ old('primary_interest') == 'Education' ? 'selected' : '' }}>Education</option>
                                <option value="Manufacturing" {{ old('primary_interest') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                                <option value="Retail" {{ old('primary_interest') == 'Retail' ? 'selected' : '' }}>Retail</option>
                                <option value="Consulting" {{ old('primary_interest') == 'Consulting' ? 'selected' : '' }}>Consulting</option>
                                <option value="Other" {{ old('primary_interest') == 'Other' ? 'selected' : '' }}>Other</option>
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
                                skills: @js(old('skills', [''])),
                                searchSkills: @js(array_fill(0, count(old('skills', [''])), '')),
                                openSkills: @js(array_fill(0, count(old('skills', [''])), false)),
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
                                Skills (Max 5)
                            </label>
                            <template
                                x-for="(skill, index) in skills"
                                :key="index"
                            >
                                <div class="flex items-center mb-2">
                                    <div class="relative flex-1">
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
                                    <button
                                        type="button"
                                        @click="skills.splice(index, 1); searchSkills.splice(index, 1); openSkills.splice(index, 1)"
                                        x-show="skills.length > 1"
                                        class="ml-2 rounded bg-red-500 px-2 py-1 text-xs text-white hover:bg-red-700"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </template>
                            <button
                                type="button"
                                @click="if (skills.length < 5) { skills.push(''); searchSkills.push(''); openSkills.push(false); }"
                                :disabled="skills.length >= 5"
                                class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-700 disabled:bg-gray-400"
                            >
                                Add Skill
                            </button>
                            @error('skills')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div
                            class="mb-4"
                            x-data="{
                                wishlists: @js(old('wishlists', [''])),
                            }"
                        >
                            <label
                                class="block text-sm font-medium text-gray-700"
                            >
                                Company Wishlists
                            </label>
                            <template
                                x-for="(wishlist, index) in wishlists"
                                :key="index"
                            >
                                <div class="flex items-center mb-2">
                                    <input
                                        type="text"
                                        x-model="wishlists[index]"
                                        placeholder="Enter company name..."
                                        class="block w-full rounded-md border-gray-300 shadow-sm flex-1"
                                    />
                                    <input
                                        type="hidden"
                                        :name="'wishlists[' + index + ']'"
                                        x-model="wishlists[index]"
                                    />
                                    <button
                                        type="button"
                                        @click="wishlists.splice(index, 1)"
                                        x-show="wishlists.length > 1"
                                        class="ml-2 rounded bg-red-500 px-2 py-1 text-xs text-white hover:bg-red-700"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </template>
                            <button
                                type="button"
                                @click="wishlists.push('')"
                                class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-700"
                            >
                                Add Company
                            </button>
                            @error('wishlists')
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