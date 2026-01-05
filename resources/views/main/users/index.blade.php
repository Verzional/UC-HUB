<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Users</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-medium">Users List</h3>
                        <a
                            href="{{ route('users.create') }}"
                            class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                        >
                            Add New User
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
                                    Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Email
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Student ID
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Role
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($users as $user)
                                <tr>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900"
                                    >
                                        {{ $user->name }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                                    >
                                        {{ $user->email }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                                    >
                                        {{ $user->student_id ?? 'N/A' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                                    >
                                        {{ $user->role ?? 'Student' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium"
                                    >
                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            class="mr-2 text-indigo-600 hover:text-indigo-900"
                                        >
                                            View
                                        </a>
                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="mr-2 text-indigo-600 hover:text-indigo-900"
                                        >
                                            Edit
                                        </a>
                                        <form
                                            method="POST"
                                            action="{{ route('users.destroy', $user) }}"
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

                    @if ($users->isEmpty())
                        <p class="py-4 text-center">No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
