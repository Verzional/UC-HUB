<x-app-layout>
    <div class="py-10 bg-[#FFF6EE] min-h-screen">
        <div class="max-w-6xl mx-auto space-y-6 px-4">

            {{-- PROFILE CARD --}}
            <div x-data="{ editing: @json($errors->any()) }" class="bg-white rounded-2xl shadow p-6">
                {{-- ================= VIEW MODE ================= --}}
                <div x-show="!editing" x-transition class="flex items-center justify-between">
                    <div class="flex items-center gap-5">

                        {{-- Avatar --}}
                        @if ($user->profile_photo_path)
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                class="w-20 h-20 rounded-full object-cover" />
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-300"></div>
                        @endif

                        {{-- Main Info --}}
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">
                                {{ $user->name }}
                            </h2>

                            <p class="text-sm text-gray-500">
                                {{ $user->major ?? 'N/A' }} · Cohort {{ $user->cohort_year ?? 'N/A' }}
                            </p>

                            <div class="mt-2 text-sm text-gray-600 space-y-1">
                                <p>📧 {{ $user->email }}</p>
                                <p>📞 {{ $user->phone_number ?? 'N/A' }}</p>
                                <p>🎓 Student ID: {{ $user->student_id ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Edit Button --}}
                    <button @click="editing = true"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-full text-sm font-medium">
                        Edit profile
                    </button>
                </div>

                {{-- ================= EDIT MODE ================= --}}
                <div x-show="editing" x-transition class="space-y-6">
                    <h3 class="text-lg font-semibold">Edit Profile Information</h3>

                    <form action="{{ route('profile.update') }}" method="POST"
                        class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="text-sm text-gray-600">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Major</label>
                            <input type="text" name="major" value="{{ old('major', $user->major) }}"
                                class="w-full rounded-lg border-gray-300">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Cohort Year</label>
                            <input type="number" name="cohort_year"
                                value="{{ old('cohort_year', $user->cohort_year) }}"
                                class="w-full rounded-lg border-gray-300" placeholder="e.g. 2023">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Phone Number</label>
                            <input type="text" name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}"
                                class="w-full rounded-lg border-gray-300">
                        </div>

                        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
                            <button type="button" @click="editing = false"
                                class="px-5 py-2 rounded-full text-sm text-gray-600 border">
                                Cancel
                            </button>

                            <button type="submit"
                                class="px-6 py-2 rounded-full text-sm bg-orange-500 text-white hover:bg-orange-600">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- ABOUT --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold mb-3">About</h3>

                <form action="{{ route('profile.update.extra') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <textarea name="about" rows="4"
                        placeholder="Tell us about yourself. Add a short bio highlighting your background, interests, or career goals."
                        class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 text-sm">{{ old('about', $user->about) }}</textarea>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-full text-sm font-medium">
                            Save About
                        </button>
                    </div>
                </form>
            </div>


            <div class="bg-white p-6 rounded-2xl shadow space-y-6">
                <h3 class="text-lg font-semibold">Portfolio & CV</h3>

                <form action="{{ route('profile.update.extra') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PATCH')

                    {{-- PORTFOLIO LINK --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Portfolio Link
                        </label>
                        <input type="url" name="portfolio_path" placeholder="https://your-portfolio.com"
                            value="{{ old('portfolio_path', $user->portfolio_path) }}"
                            class="mt-1 w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500" />
                        <p class="text-xs text-gray-500 mt-1">
                            Add a link to your portfolio (Behance, GitHub, personal website)
                        </p>
                    </div>

                    {{-- CV --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Curriculum Vitae (CV)
                        </label>

                        @if ($user->cv_path)
                            <div class="border rounded-lg p-4 flex items-center justify-between bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📄</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">
                                            CV_{{ $user->name }}.pdf
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Uploaded CV
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <a href="{{ asset('storage/' . $user->cv_path) }}" target="_blank"
                                        class="text-blue-600 text-sm hover:underline">
                                        View
                                    </a>

                                    <a href="{{ asset('storage/' . $user->cv_path) }}" download
                                        class="text-gray-600 text-sm hover:underline">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">
                                No CV uploaded yet.
                            </p>
                        @endif

                        {{-- Upload --}}
                        <input type="file" name="cv_path" accept="application/pdf"
                            class="mt-3 w-full text-sm text-gray-600" />
                    </div>


                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full text-sm font-medium">
                            Save
                        </button>
                    </div>
                </form>
            </div>


            {{-- ABOUT YOU --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold mb-3">Account Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Created At</p>
                        <p class="text-gray-900">
                            {{ $user->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Last Updated</p>
                        <p class="text-gray-900">
                            {{ $user->updated_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
