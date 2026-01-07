<x-guest-layout>
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Student Registration</h1>
        <p class="text-gray-500">Join UC Hub to discover career opportunities</p>
    </div>

    <div class="flex justify-center items-center mb-12">
        <div class="flex flex-col items-center">
            <div
                class="w-10 h-10 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-orange-200">
                1</div>
            <span class="text-xs mt-2 font-semibold text-gray-500">Profile</span>
        </div>
        <div class="w-16 h-[2px] bg-orange-200 mx-2 -mt-5"></div>
        <div class="flex flex-col items-center opacity-40">
            <div
                class="w-10 h-10 border-2 border-orange-500 text-orange-500 rounded-full flex items-center justify-center font-bold">
                2</div>
            <span class="text-xs mt-2 font-semibold text-gray-500">Survey</span>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" class="font-bold text-gray-800" :value="__('Name *')" />
            <x-text-input id="name"
                class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                type="text" name="name" :value="old('name')" required autofocus placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" class="font-bold text-gray-800" :value="__('Ciputra Email *')" />
            <x-text-input id="email"
                class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                type="email" name="email" :value="old('email')" required placeholder="username@student.ciputra.ac.id" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="student_id" class="font-bold text-gray-800" :value="__('Student ID *')" />
            <x-text-input id="student_id"
                class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                type="text" name="student_id" :value="old('student_id')" required placeholder="e.g. 0706012110001" />
            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" class="font-bold text-gray-800" :value="__('Password *')" />
                <x-text-input id="password"
                    class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" class="font-bold text-gray-800" :value="__('Confirm Password *')" />
                <x-text-input id="password_confirmation"
                    class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="pt-6">
            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-full transition duration-300 shadow-lg shadow-orange-200 uppercase tracking-wide">
                Next Step
            </button>

            <div class="mt-8 text-center">
                <span class="text-gray-500 text-sm">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-orange-500 font-bold text-sm hover:underline ml-1">Sign
                    In</a>
            </div>
        </div>
    </form>
</x-guest-layout>
