<x-guest-layout>
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Student Registration</h1>
        <p class="text-gray-500">Join UC Hub to discover career opportunities</p>
    </div>

    <div class="flex justify-center items-center mb-12">
        <div class="flex flex-col items-center">
            <div
                class="w-10 h-10 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold shadow-lg opacity-60">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <span class="text-xs mt-2 font-semibold text-gray-500">Profile</span>
        </div>
        <div class="w-16 h-[2px] bg-orange-500 mx-2 -mt-5 opacity-60"></div>
        <div class="flex flex-col items-center">
            <div
                class="w-10 h-10 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-orange-200">
                2</div>
            <span class="text-xs mt-2 font-semibold text-gray-800">Survey</span>
        </div>
    </div>

    <form method="POST" action="{{ route('surveys.store') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="primary_interest" class="font-bold text-gray-800" :value="__('Primary Interest *')" />
            <select name="primary_interest" id="primary_interest"
                class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3 text-gray-600 shadow-sm"
                required>
                <option value="">Pilih minat utama</option>
                <option value="Technology" {{ old('primary_interest') == 'Technology' ? 'selected' : '' }}>Technology
                </option>
                <option value="Finance" {{ old('primary_interest') == 'Finance' ? 'selected' : '' }}>Finance</option>
                <option value="Healthcare" {{ old('primary_interest') == 'Healthcare' ? 'selected' : '' }}>Healthcare
                </option>
                <option value="Education" {{ old('primary_interest') == 'Education' ? 'selected' : '' }}>Education
                </option>
                <option value="Manufacturing" {{ old('primary_interest') == 'Manufacturing' ? 'selected' : '' }}>
                    Manufacturing</option>
                <option value="Retail" {{ old('primary_interest') == 'Retail' ? 'selected' : '' }}>Retail</option>
                <option value="Consulting" {{ old('primary_interest') == 'Consulting' ? 'selected' : '' }}>Consulting
                </option>
                <option value="Other" {{ old('primary_interest') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error :messages="$errors->get('primary_interest')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="cgpa" class="font-bold text-gray-800" :value="__('Current GPA/IPK *')" />
            <x-text-input id="cgpa"
                class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                type="number" step="0.01" min="0" max="4" name="cgpa" :value="old('cgpa')" required
                placeholder="e.g. 3.75" />
            <x-input-error :messages="$errors->get('cgpa')" class="mt-2" />
        </div>

        <div x-data="{
            allSkills: @js($skills->toArray()),
            skills: @js(old('skills', [''])),
            add() { if (this.skills.length < 5) this.skills.push('') }
        }">
            <x-input-label class="font-bold text-gray-800" :value="__('Skill Utama * (Max 5)')" />
            <template x-for="(skill, index) in skills" :key="index">
                <div class="flex items-center gap-2 mt-2">
                    <select x-model="skills[index]" :name="'skills[' + index + ']'"
                        class="block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3 text-gray-600 shadow-sm"
                        required>
                        <option value="">Pilih skill</option>
                        <template x-for="s in allSkills" :key="s.id">
                            <option :value="s.id" x-text="s.name"></option>
                        </template>
                    </select>
                    <button type="button" @click="add()" x-show="index === skills.length - 1"
                        class="bg-orange-500 text-white px-5 py-3 rounded-xl font-bold hover:bg-orange-600">
                        Add
                    </button>
                    <button type="button" @click="skills.splice(index, 1)" x-show="skills.length > 1"
                        class="bg-red-100 text-red-600 px-3 py-3 rounded-xl font-bold hover:bg-red-200">
                        &times;
                    </button>
                </div>
            </template>
            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
        </div>

        <div x-data="{
            wishlists: @js(old('wishlists', [''])),
            add() { this.wishlists.push('') }
        }">
            <x-input-label class="font-bold text-gray-800" :value="__('Company Wishlist')" />
            <template x-for="(wish, index) in wishlists" :key="index">
                <div class="flex items-center gap-2 mt-2">
                    <x-text-input
                        class="block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                        type="text" x-bind:name="'wishlists[' + index + ']'" x-model="wishlists[index]"
                        placeholder="e.g. Traveloka, Google..." />
                    <button type="button" @click="add()" x-show="index === wishlists.length - 1"
                        class="bg-orange-500 text-white px-5 py-3 rounded-xl font-bold hover:bg-orange-600">
                        Add
                    </button>
                </div>
            </template>
        </div>

        <div class="flex items-center gap-4 pt-6">
            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-full transition shadow-lg shadow-orange-200 uppercase tracking-wide">
                Submit Survey
            </button>
        </div>
    </form>
</x-guest-layout>
