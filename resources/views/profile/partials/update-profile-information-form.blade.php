<section id="update-profile-information">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your personal and academic information.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        {{-- NAME --}}
        <div>
            <x-input-label for="name" value="Full Name" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- EMAIL --}}
        <div>
            <x-input-label for="email" value="Email Address" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- PHONE NUMBER --}}
        <div>
            <x-input-label for="phone_number" value="Phone Number" />
            <x-text-input
                id="phone_number"
                name="phone_number"
                type="text"
                class="mt-1 block w-full"
                :value="old('phone_number', $user->phone_number)"
                placeholder="+62xxxxxxxxxx"
            />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        {{-- STUDENT ID --}}
        <div>
            <x-input-label for="student_id" value="Student ID" />
            <x-text-input
                id="student_id"
                name="student_id"
                type="text"
                class="mt-1 block w-full"
                :value="old('student_id', $user->student_id)"
            />
            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
        </div>

        {{-- MAJOR --}}
        <div>
            <x-input-label for="major" value="Major" />
            <x-text-input
                id="major"
                name="major"
                type="text"
                class="mt-1 block w-full"
                :value="old('major', $user->major)"
                placeholder="Informatics"
            />
            <x-input-error :messages="$errors->get('major')" class="mt-2" />
        </div>

        {{-- COHORT YEAR --}}
        <div>
            <x-input-label for="cohort_year" value="Cohort Year" />
            <x-text-input
                id="cohort_year"
                name="cohort_year"
                type="number"
                class="mt-1 block w-full"
                :value="old('cohort_year', $user->cohort_year)"
                placeholder="2023"
            />
            <x-input-error :messages="$errors->get('cohort_year')" class="mt-2" />
        </div>

        {{-- SAVE --}}
        <div class="flex items-center gap-4">
            <x-primary-button>
                Save Changes
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
