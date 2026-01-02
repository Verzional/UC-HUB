<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Applications
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-medium">Applications List</h3>
                        <a
                            href="{{ route('applications.create') }}"
                            class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                        >
                            Add New Application
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
                                    User
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Job
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($applications as $application)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900"
                                    >
                                        {{ $application->user->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                                    >
                                        {{ $application->job->title }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                                    >
                                        {{ $application->status ?? 'Pending' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium"
                                    >
                                        <a
                                            href="{{ route('applications.show', $application) }}"
                                            class="mr-2 text-indigo-600 hover:text-indigo-900"
                                        >
                                            View
                                        </a>
                                        <a
                                            href="{{ route('applications.edit', $application) }}"
                                            class="mr-2 text-indigo-600 hover:text-indigo-900"
                                        >
                                            Edit
                                        </a>
                                        <form
                                            method="POST"
                                            action="{{ route('applications.destroy', $application) }}"
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

                    @if ($applications->isEmpty())
                        <p class="py-4 text-center">No applications found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
