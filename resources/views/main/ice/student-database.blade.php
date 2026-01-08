<x-app-layout>
    <div class="py-16 bg-gradient-to-br from-orange-50 via-white to-orange-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 space-y-10">

            <!-- Page Header -->
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">
                    Student Database
                </h1>
                <p class="text-gray-500 mt-1">
                    Filter and recommend students for internship opportunities
                </p>
            </div>

            <!-- Filter Section -->
            <div
                class="bg-white border border-gray-100 rounded-3xl p-6 shadow-lg"
            >
                <h2 class="text-lg font-bold text-gray-800 mb-6">
                    Search & Smart Filter
                </h2>

                <form class="grid grid-cols-1 md:grid-cols-4 gap-5">

                    <!-- IPK -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">
                            Minimum IPK
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            placeholder="e.g. 3.50"
                            class="w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500"
                        >
                    </div>

                    <!-- Skill -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">
                            Skill
                        </label>
                        <input
                            type="text"
                            placeholder="Python, Data Analysis"
                            class="w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500"
                        >
                    </div>

                    <!-- Experience -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">
                            Experience
                        </label>
                        <select
                            class="w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500"
                        >
                            <option value="">All</option>
                            <option>None</option>
                            <option>Organization</option>
                            <option>Internship</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">
                            Internship Status
                        </label>
                        <select
                            class="w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500"
                        >
                            <option value="">All</option>
                            <option>Not Placed</option>
                            <option>Placed</option>
                        </select>
                    </div>

                    <!-- Button -->
                    <div class="md:col-span-4 flex justify-end pt-2">
                        <button
                            type="button"
                            class="px-1 py-1 bg-orange-500 text-white rounded-full font-semibold
                                   hover:bg-orange-600 transition shadow"
                        >
                            Search Students
                        </button>
                    </div>

                </form>
            </div>

            <!-- Student List -->
            <div class="space-y-6">

                <h2 class="text-lg font-bold text-gray-800">
                    Student Results
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Student Card -->
                    <div
                        class="bg-white rounded-3xl border border-gray-100 p-6 hover:shadow-2xl transition"
                    >
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    Alicia Putri
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Information Systems
                                </p>
                            </div>

                            <span
                                class="px-3 py-1 text-xs font-bold rounded-full
                                       bg-green-100 text-green-700"
                            >
                                Not Placed
                            </span>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2 text-sm">
                            <span class="px-3 py-1 bg-gray-100 rounded-full">
                                IPK 3.78
                            </span>
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full">
                                Python
                            </span>
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full">
                                Data Analysis
                            </span>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a
                                href="{{ url('/ice/students/1') }}"
                                class="px-4 py-2 text-sm rounded-full border
                                       hover:bg-gray-50"
                            >
                                View Detail
                            </a>

                            <button
                                class="px-4 py-2 text-sm rounded-full bg-orange-500 text-white
                                       hover:bg-orange-600 transition"
                            >
                                Recommend
                            </button>
                        </div>
                    </div>

                    <!-- Duplicate Card -->
                    <div
                        class="bg-white rounded-3xl border border-gray-100 p-6
                               hover:shadow-xl transition"
                    >
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    Bima Pratama
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Computer Science
                                </p>
                            </div>

                            <span
                                class="px-3 py-1 text-xs font-bold rounded-full
                                       bg-yellow-100 text-yellow-700"
                            >
                                Placed
                            </span>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2 text-sm">
                            <span class="px-3 py-1 bg-gray-100 rounded-full">
                                IPK 3.52
                            </span>
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full">
                                Java
                            </span>
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full">
                                Backend
                            </span>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a
                                href="{{ url('/ice/students/2') }}"
                                class="px-4 py-2 text-sm rounded-full border
                                       hover:bg-gray-50"
                            >
                                View Detail
                            </a>

                            <button
                                class="px-4 py-2 text-sm rounded-full bg-orange-500 text-white
                                       hover:bg-orange-600 transition"
                            >
                                Recommend
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>