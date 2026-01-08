{{-- resources/views/jobs/partials/saved-jobs-list.blade.php --}}

@if ($savedJobs->count() > 0)
    {{-- Summary Bar --}}
    <div class="flex justify-between items-center mb-6 animate-fade-in">
        <h2 class="text-xl font-bold text-[#2D3436]">
            Saved Jobs <span class="ml-2 text-sm font-normal text-[#636E72] bg-white px-3 py-1 rounded-full shadow-sm border border-gray-100">{{ $savedJobs->count() }} Items</span>
        </h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach ($savedJobs as $job)
            <div class="group bg-white rounded-[24px] p-6 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-[0_15px_30px_rgba(255,140,66,0.1)] transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                {{-- Accent Line --}}
                <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-[#FF8C42] to-[#FF3E8D] opacity-0 group-hover:opacity-100 transition-opacity"></div>

                <div class="flex items-start gap-5">
                    {{-- Logo --}}
                    <div class="w-16 h-16 rounded-2xl bg-gray-50 border border-gray-100 p-2 flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                        <img src="{{ $job->company->logo_url }}" alt="{{ $job->company->name }}" class="w-full h-full object-contain">
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="text-lg font-bold text-[#2D3436] truncate pr-4 group-hover:text-[#FF8C42] transition-colors">
                                <a href="{{ route('jobs.show', $job->id) }}" class="focus:outline-none">
                                    {{ $job->title }}
                                </a>
                            </h3>
                            <button onclick="openDeleteModal('{{ $job->id }}', '{{ $job->title }}')" 
                                class="text-gray-300 hover:text-[#FF3B30] hover:bg-red-50 p-1.5 rounded-lg transition-colors z-10 relative" title="Remove">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>

                        <p class="text-sm text-[#636E72] font-medium mb-4">{{ $job->company->name }}</p>

                        <div class="flex flex-wrap gap-2 mb-5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-gray-50 text-gray-600 border border-gray-200">
                                <svg class="w-3 h-3 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $job->location }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-orange-50 text-orange-600 border border-orange-100">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $job->type }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <span class="text-xs text-[#B2B2B2]">Added {{ $job->pivot->created_at->diffForHumans() }}</span>
                            <a href="{{ route('jobs.show', $job->id) }}" class="text-sm font-bold text-[#FF8C42] flex items-center hover:underline">
                                Apply Now <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    {{-- EMPTY STATE --}}
    <div class="bg-white rounded-[30px] p-12 flex flex-col items-center justify-center text-center shadow-[0_10px_40px_rgba(0,0,0,0.03)] min-h-[400px] border border-gray-100 animate-fade-in-up">
        <div class="w-32 h-32 bg-orange-50 rounded-full flex items-center justify-center mb-6 relative">
            <div class="absolute inset-0 bg-[#FF8C42] opacity-20 rounded-full animate-ping" style="animation-duration: 3s;"></div>
            <svg class="w-14 h-14 text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
        </div>
        <h2 class="text-2xl font-bold text-[#2D3436] mb-2">No Saved Jobs Found</h2>
        <p class="text-[#636E72] mb-8 max-w-sm mx-auto leading-relaxed">
            @if(request('q'))
                We couldn't find any saved jobs matching "<strong>{{ request('q') }}</strong>".
            @else
                It seems you haven't bookmarked any opportunities yet.
            @endif
        </p>
        <a href="{{ route('jobs.index') }}" class="bg-[#2D3436] hover:bg-black text-white font-bold py-3.5 px-10 rounded-full shadow-lg transition duration-200">Explore Jobs</a>
    </div>
@endif