<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Application Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-medium">
                            Application for {{ $application->job->title }}
                        </h3>
                        <div>
                            <a
                                href="{{ route('applications.edit', $application) }}"
                                class="mr-2 rounded bg-yellow-500 px-4 py-2 font-bold text-white hover:bg-yellow-700"
                            >
                                Edit
                            </a>
                            <a
                                href="{{ route('applications.index') }}"
                                class="rounded bg-gray-500 px-4 py-2 font-bold text-white hover:bg-gray-700"
                            >
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <h4 class="font-semibold text-gray-700">User</h4>
                            <p class="text-gray-900">
                                {{ $application->user->name }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Job</h4>
                            <p class="text-gray-900">
                                {{ $application->job->title }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Status</h4>
                            <p class="text-gray-900">
                                {{ $application->status ?? 'Pending' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Resume Path
                            </h4>
                            <p class="text-gray-900">
                                {{ $application->resume_path ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Portfolio Path
                            </h4>
                            <p class="text-gray-900">
                                {{ $application->portfolio_path ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="font-semibold text-gray-700">
                                Cover Letter
                            </h4>
                            <p class="text-gray-900">
                                {{ $application->cover_letter ?? 'No cover letter provided.' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Created At
                            </h4>
                            <p class="text-gray-900">
                                {{ $application->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Updated At
                            </h4>
                            <p class="text-gray-900">
                                {{ $application->updated_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <form
                            method="POST"
                            action="{{ route('applications.destroy', $application) }}"
                            class="inline"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                                onclick="
                                    return confirm(
                                        'Are you sure you want to delete this application?',
                                    );
                                "
                            >
                                Delete Application
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
