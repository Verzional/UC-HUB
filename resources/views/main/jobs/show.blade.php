<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Job Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-medium">{{ $job->title }}</h3>
                        <div>
                            <a
                                href="{{ route('jobs.edit', $job) }}"
                                class="mr-2 rounded bg-yellow-500 px-4 py-2 font-bold text-white hover:bg-yellow-700"
                            >
                                Edit
                            </a>
                            <a
                                href="{{ route('jobs.index') }}"
                                class="rounded bg-gray-500 px-4 py-2 font-bold text-white hover:bg-gray-700"
                            >
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <h4 class="font-semibold text-gray-700">Title</h4>
                            <p class="text-gray-900">{{ $job->title }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Company</h4>
                            <p class="text-gray-900">
                                {{ $job->company->name }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Location
                            </h4>
                            <p class="text-gray-900">
                                {{ $job->location ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Employment Type
                            </h4>
                            <p class="text-gray-900">
                                {{ $job->employment_type ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Salary</h4>
                            <p class="text-gray-900">
                                {{ $job->salary ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Application Deadline
                            </h4>
                            <p class="text-gray-900">
                                {{ $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') : 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Start Time
                            </h4>
                            <p class="text-gray-900">
                                {{ $job->start_time ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                End Time
                            </h4>
                            <p class="text-gray-900">
                                {{ $job->end_time ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="font-semibold text-gray-700">
                                Description
                            </h4>
                            <p class="text-gray-900">
                                {{ $job->description }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="font-semibold text-gray-700">Skills</h4>
                            @if ($job->skills->isNotEmpty())
                                <ul class="list-inside list-disc text-gray-900">
                                    @foreach ($job->skills as $skill)
                                        <li>
                                            {{ $skill->name }}
                                            ({{ $skill->industry }})
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-900">
                                    No skills associated.
                                </p>
                            @endif
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Created At
                            </h4>
                            <p class="text-gray-900">
                                {{ $job->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Updated At
                            </h4>
                            <p class="text-gray-900">
                                {{ $job->updated_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <form
                            method="POST"
                            action="{{ route('jobs.destroy', $job) }}"
                            class="inline"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                                onclick="
                                    return confirm(
                                        'Are you sure you want to delete this job?',
                                    );
                                "
                            >
                                Delete Job
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
