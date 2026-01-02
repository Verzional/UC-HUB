<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Jobs</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-medium">Jobs List</h3>
                        <a
                            href="{{ route('jobs.create') }}"
                            class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                        >
                            Add New Job
                        </a>
                    </div>

                    @if (session('success'))
                        <div
                            class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700"
                        >
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Title
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Company
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Location
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($jobs as $job)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900"
                                    >
                                        {{ $job->title }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                                    >
                                        {{ $job->company->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                                    >
                                        {{ $job->location ?? 'N/A' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium"
                                    >
                                        <a
                                            href="{{ route('jobs.show', $job) }}"
                                            class="mr-2 text-indigo-600 hover:text-indigo-900"
                                        >
                                            View
                                        </a>
                                        <a
                                            href="{{ route('jobs.edit', $job) }}"
                                            class="mr-2 text-indigo-600 hover:text-indigo-900"
                                        >
                                            Edit
                                        </a>
                                        <form
                                            method="POST"
                                            action="{{ route('jobs.destroy', $job) }}"
                                            class="inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="
                                                    return confirm(
                                                        'Are you sure?',
                                                    );
                                                "
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($jobs->isEmpty())
                        <p class="py-4 text-center">No jobs found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
