<x-app-layout>
    <!-- Page Background -->
    <div class="py-16 bg-gradient-to-br from-orange-50 via-white to-orange-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Page Header -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Student Detail
                </h1>
                <p class="text-gray-600">
                    Detailed academic and experience profile.
                </p>
            </div>

            <!-- Basic Information -->
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Basic Information
                </h2>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <p><strong>Name:</strong> Alicia Putri</p>
                    <p><strong>Major:</strong> Information Systems</p>
                    <p><strong>IPK:</strong> 3.78</p>
                    <p>
                        <strong>Status:</strong>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            Not Placed
                        </span>
                    </p>
                </div>
            </div>

            <!-- Skills -->
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Skills
                </h2>

                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm">
                        Python
                    </span>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm">
                        Data Analysis
                    </span>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm">
                        SQL
                    </span>
                </div>
            </div>

            <!-- Experience & Achievements -->
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Experience & Achievements
                </h2>

                <div class="mt-4">
                    <ul class="list-disc list-inside text-gray-600 text-sm space-y-2">
                        <li>Head of Data Division – Student Association</li>
                        <li>Finalist Data Science Competition 2024</li>
                        <li>Assistant Lecturer – Database Systems</li>
                    </ul>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex justify-end gap-3">
                <a
                    href="{{ url()->previous() }}"
                    class="px-4 py-2 text-sm border rounded-md hover:bg-gray-50 transition"
                >
                    Back
                </a>

                <button
                    class="px-4 py-2 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                >
                    Recommend to Job
                </button>
            </div>

        </div>
    </div>
</x-app-layout>