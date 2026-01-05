<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            User Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-medium">{{ $user->name }}</h3>
                        <div>
                            <a
                                href="{{ route('users.edit', $user) }}"
                                class="mr-2 rounded bg-yellow-500 px-4 py-2 font-bold text-white hover:bg-yellow-700"
                            >
                                Edit
                            </a>
                            <a
                                href="{{ route('users.index') }}"
                                class="rounded bg-gray-500 px-4 py-2 font-bold text-white hover:bg-gray-700"
                            >
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <h4 class="font-semibold text-gray-700">Name</h4>
                            <p class="text-gray-900">{{ $user->name }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Email</h4>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Student ID
                            </h4>
                            <p class="text-gray-900">
                                {{ $user->student_id ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Phone Number
                            </h4>
                            <p class="text-gray-900">
                                {{ $user->phone_number ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Cohort Year
                            </h4>
                            <p class="text-gray-900">
                                {{ $user->cohort_year ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Major</h4>
                            <p class="text-gray-900">
                                {{ $user->major ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">Role</h4>
                            <p class="text-gray-900">
                                {{ $user->role ?? 'Student' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Portfolio
                            </h4>
                            <p class="text-gray-900">
                                @if ($user->portfolio_path)
                                    <a
                                        href="{{ $user->portfolio_path }}"
                                        target="_blank"
                                        class="text-blue-600 hover:text-blue-900"
                                    >
                                        {{ $user->portfolio_path }}
                                    </a>
                                @else
                                        N/A
                                @endif
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Profile Photo
                            </h4>

                            @if ($user->profile_photo_path)
                                <img
                                    src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                    alt="Profile Photo"
                                    class="h-32 w-32 rounded object-cover"
                                />
                            @else
                                <p class="text-gray-900">No photo uploaded</p>
                            @endif
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">CV</h4>

                            @if ($user->cv_path)
                                <a
                                    href="{{ asset('storage/' . $user->cv_path) }}"
                                    target="_blank"
                                    class="text-blue-600 hover:text-blue-900"
                                >
                                    View CV
                                </a>
                            @else
                                <p class="text-gray-900">No CV uploaded</p>
                            @endif
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Created At
                            </h4>
                            <p class="text-gray-900">
                                {{ $user->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700">
                                Updated At
                            </h4>
                            <p class="text-gray-900">
                                {{ $user->updated_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <form
                            method="POST"
                            action="{{ route('users.destroy', $user) }}"
                            class="inline"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                                onclick="
                                    return confirm(
                                        'Are you sure you want to delete this user?',
                                    );
                                "
                            >
                                Delete User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
