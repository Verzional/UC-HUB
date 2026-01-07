<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Recommended Jobs for {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recommendations as $recommendation)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold mb-2">{{ $recommendation['job']->title }}</h2>
                                <p class="text-gray-600 mb-2">{{ $recommendation['job']->company->name }}</p>
                                <p class="text-sm text-gray-500 mb-4">{{ $recommendation['job']->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Match Score: {{ $recommendation['score'] }}%</span>
                                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Apply
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>