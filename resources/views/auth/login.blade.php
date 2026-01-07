<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Welcome Back</h1>
        <p class="text-gray-500 text-sm font-medium">Sign in to access your dashboard</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" class="font-bold text-gray-800" :value="__('Email')" />
            <x-text-input id="email"
                class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" class="font-bold text-gray-800" :value="__('Password')" />

            <x-text-input id="password"
                class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl py-3"
                type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-2">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500" name="remember" />
                <span class="ms-2 text-xs text-gray-600 font-medium">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-sky-400 hover:text-sky-500 font-bold no-underline"
                    href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl transition duration-300 shadow-lg shadow-orange-200 uppercase tracking-wide">
                Login
            </button>
        </div>

        <div class="mt-8 text-center">
            <span class="text-gray-500 text-sm">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-orange-400 font-bold text-sm hover:underline ml-1">Sign Up</a>
        </div>
    </form>
</x-guest-layout>
