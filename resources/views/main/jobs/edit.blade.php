<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Job
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-gray-50 p-6 rounded-lg shadow space-y-6">

                <h2 class="text-2xl font-bold text-orange-600 text-center">Edit Job</h2>

                <form method="POST" action="{{ route('jobs.update', $job) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="bg-white rounded-lg shadow p-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="bg-white rounded-lg shadow p-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $job->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- <div class="bg-white rounded-lg shadow p-4"
                         x-data="{
                            companies: @json($companies),
                            selectedCompany: @json(old('company_id', $job->company_id)),
                            searchCompany: '',
                            openCompany: false,
                            init: function(){
                                if(this.selectedCompany){
                                    var c = this.companies.find(function(x){ return x.id == this.selectedCompany; }.bind(this));
                                    if(c) this.searchCompany = c.name;
                                }
                            }
                         }" x-init="init()">
                        <label class="block text-sm font-medium text-gray-700">Company</label>
                        <div class="relative">
                            <input type="text" x-model="searchCompany" @focus="openCompany=true" @blur="openCompany=false"
                                   placeholder="Search and select company..."
                                   class="block w-full rounded-md border-gray-300 shadow-sm" required>
                            <ul x-show="openCompany" class="absolute z-10 max-h-60 w-full overflow-y-auto rounded-md border border-gray-300 bg-white shadow-lg">
                                <template x-for="company in companies.filter(c => c.name.toLowerCase().includes(searchCompany.toLowerCase()))" :key="company.id">
                                    <li @mousedown.prevent="selectedCompany = company.id; searchCompany = company.name; openCompany = false"
                                        class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                                        x-text="company.name"></li>
                                </template>
                            </ul>
                        </div>
                        <input type="hidden" name="company_id" x-model="selectedCompany">
                        @error('company_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div> --}}

                    {{-- Employment Type --}}
                    <div class="bg-white rounded-lg shadow p-4">
                        <label class="block text-sm font-medium text-gray-700">Employment Type</label>
                        <select name="employment_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Select Type</option>
                            <option value="Full-time" {{ old('employment_type', $job->employment_type)=='Full-time'?'selected':'' }}>Full-time</option>
                            <option value="Part-time" {{ old('employment_type', $job->employment_type)=='Part-time'?'selected':'' }}>Part-time</option>
                            <option value="Contract" {{ old('employment_type', $job->employment_type)=='Contract'?'selected':'' }}>Contract</option>
                            <option value="Internship" {{ old('employment_type', $job->employment_type)=='Internship'?'selected':'' }}>Internship</option>
                        </select>
                        @error('employment_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Salary --}}
                    <div class="bg-white rounded-lg shadow p-4">
                        <label class="block text-sm font-medium text-gray-700">Salary</label>
                        <input type="text" name="salary" value="{{ old('salary', $job->salary) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('salary') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Application Deadline --}}
                    <div class="bg-white rounded-lg shadow p-4">
                        <label class="block text-sm font-medium text-gray-700">Application Deadline</label>
                        <input type="date" name="application_deadline" value="{{ old('application_deadline', $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('application_deadline') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Start Time --}}
                    <div class="bg-white rounded-lg shadow p-4">
                        <label class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" name="start_time" value="{{ old('start_time', $job->start_time ? substr($job->start_time,0,5) : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('start_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- End Time --}}
                    <div class="bg-white rounded-lg shadow p-4">
                        <label class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" name="end_time" value="{{ old('end_time', $job->end_time ? substr($job->end_time,0,5) : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('end_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Skills
                    <div class="bg-white rounded-lg shadow p-4"
                         x-data="{
                            allSkills: @json($skills),
                            skills: @json(old('skills', $job->skills->pluck('id')->toArray() ?: [''])),
                            searchSkills: Array(@json(old('skills', $job->skills->pluck('id')->toArray() ?: [''])).length).fill(''),
                            openSkills: Array(@json(old('skills', $job->skills->pluck('id')->toArray() ?: [''])).length).fill(false),
                            init: function(){
                                this.skills.forEach(function(skillId, index){
                                    if(skillId){
                                        var s = this.allSkills.find(function(x){ return x.id==skillId }.bind(this));
                                        if(s) this.searchSkills[index] = s.name + ' (' + s.industry + ')';
                                    }
                                }.bind(this));
                            }
                         }" x-init="init()">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                        <template x-for="(skill,index) in skills" :key="index">
                            <div class="mb-2">
                                <div class="relative">
                                    <input type="text" x-model="searchSkills[index]" @focus="openSkills[index]=true" @blur="openSkills[index]=false"
                                           placeholder="Search and select skill..." class="block w-full rounded-md border-gray-300 shadow-sm">
                                    <ul x-show="openSkills[index]" class="absolute z-10 max-h-60 w-full overflow-y-auto rounded-md border border-gray-300 bg-white shadow-lg">
                                        <template x-for="skillOption in allSkills.filter(s => (s.name + ' ' + s.industry).toLowerCase().includes(searchSkills[index].toLowerCase()))" :key="skillOption.id">
                                            <li @mousedown.prevent="skills[index]=skillOption.id; searchSkills[index]=skillOption.name + ' (' + skillOption.industry + ')'; openSkills[index]=false"
                                                class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                                                x-text="skillOption.name + ' (' + skillOption.industry + ')'"></li>
                                        </template>
                                    </ul>
                                </div>
                                <input type="hidden" :name="'skills['+index+']'" x-model="skills[index]">
                                <button type="button" @click="skills.splice(index,1); searchSkills.splice(index,1); openSkills.splice(index,1)"
                                        x-show="skills.length>1" class="mt-1 rounded bg-red-500 px-2 py-1 text-xs text-white hover:bg-red-700">Remove</button>
                            </div>
                        </template>
                        <button type="button" @click="skills.push(''); searchSkills.push(''); openSkills.push(false)"
                                class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-700 mt-2">Add Skill</button>
                        @error('skills') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div> --}}

                    {{-- Action Buttons --}}
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('jobs.show', $job) }}" class="rounded bg-gray-300 px-4 py-2 font-bold text-gray-800 hover:bg-gray-400 transition">Cancel</a>
                        <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-bold text-white hover:bg-orange-700 transition">Update Job</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
