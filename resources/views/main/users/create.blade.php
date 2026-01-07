<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Create User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form
                        method="POST"
                        action="{{ route('users.store') }}"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="mb-4">
                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            />
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            />
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            />
                            @error('password')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="password_confirmation"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Confirm Password
                            </label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            />
                        </div>

                        <div class="mb-4">
                            <label
                                for="student_id"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Student ID
                            </label>
                            <input
                                type="text"
                                name="student_id"
                                id="student_id"
                                value="{{ old('student_id') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('student_id')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="phone_number"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Phone Number
                            </label>
                            <input
                                type="text"
                                name="phone_number"
                                id="phone_number"
                                value="{{ old('phone_number') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('phone_number')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="cohort_year"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Cohort Year
                            </label>
                            <input
                                type="number"
                                name="cohort_year"
                                id="cohort_year"
                                value="{{ old('cohort_year') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('cohort_year')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="major"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Major
                            </label>
                            <input
                                type="text"
                                name="major"
                                id="major"
                                value="{{ old('major') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('major')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="role"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Role
                            </label>
                            <select
                                name="role"
                                id="role"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            >
                                <option value="">Select Role</option>
                                <option
                                    value="student"
                                    {{ old('role') == 'student' ? 'selected' : '' }}
                                >
                                    Student
                                </option>
                                <option
                                    value="ice"
                                    {{ old('role') == 'ice' ? 'selected' : '' }}
                                >
                                    ICE
                                </option>
                                <option
                                    value="admin"
                                    {{ old('role') == 'admin' ? 'selected' : '' }}
                                >
                                    Admin
                                </option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="profile_photo_path"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Profile Photo
                            </label>
                            <input
                                type="file"
                                name="profile_photo_path"
                                id="profile_photo_path"
                                accept="image/*"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('profile_photo_path')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="cv_path"
                                class="block text-sm font-medium text-gray-700"
                            >
                                CV
                            </label>
                            <input
                                type="file"
                                name="cv_path"
                                id="cv_path"
                                accept=".pdf,.doc,.docx"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('cv_path')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label
                                for="portfolio_path"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Portfolio URL
                            </label>
                            <input
                                type="url"
                                name="portfolio_path"
                                id="portfolio_path"
                                value="{{ old('portfolio_path') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            />
                            @error('portfolio_path')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a
                                href="{{ route('users.index') }}"
                                class="mr-2 rounded bg-gray-300 px-4 py-2 font-bold text-gray-800 hover:bg-gray-400"
                            >
                                Cancel
                            </a>
                            <button
                                type="submit"
                                class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                            >
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
