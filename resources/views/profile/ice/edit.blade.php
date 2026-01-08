<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 space-y-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-semibold mb-4">ICE Profile</h2>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="text-sm text-gray-600">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full rounded-lg border-gray-300">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border-gray-300">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Role</label>
                    <input type="text" value="ICE" disabled
                        class="w-full rounded-lg border-gray-200 bg-gray-100">
                </div>

                <div class="flex justify-end">
                    <button class="bg-orange-500 text-white px-6 py-2 rounded-full">
                        Save
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
