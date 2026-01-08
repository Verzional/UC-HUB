{{-- HEADER SMALL SUMMARY --}}
<div class="flex justify-between items-end mb-4 border-b border-gray-200 pb-3">
    <h2 class="text-lg font-bold text-[#2D3436]">
        Available Jobs <span class="ml-2 text-xs font-normal text-[#636E72] bg-white px-2 py-1 rounded-full border border-gray-200">{{ $jobs->total() }} results</span>
    </h2>
    <div class="text-[11px] text-[#636E72] hidden md:block">
        Page <span class="font-bold text-[#2D3436]">{{ $jobs->currentPage() }}</span> of <span class="font-bold text-[#2D3436]">{{ $jobs->lastPage() }}</span>
    </div>
</div>

@forelse($jobs as $job)
    {{-- JOB CARD (CLEAN & DETAIL) --}}
    <a href="{{ route('jobs.show', $job->id) }}"
        class="group block bg-white p-5 rounded-[20px] shadow-sm hover:shadow-[0_8px_25px_rgba(0,0,0,0.05)] transition-all duration-300 mb-4 border border-transparent hover:border-orange-100 relative overflow-hidden hover:-translate-y-0.5">
        
        <div class="flex items-start md:items-center gap-5">

            {{-- Company Logo --}}
            <div class="w-14 h-14 rounded-xl bg-gray-50 border border-gray-100 p-2 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                <img src="{{ $job->company->logo_url }}" alt="{{ $job->company_name }}" class="w-full h-full object-contain">
            </div>

            {{-- Job Info --}}
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-bold text-[#2D3436] group-hover:text-[#FF8C42] transition-colors mb-0.5 truncate pr-8">
                    {{ $job->title }}
                </h3>
                <p class="text-[#636E72] text-sm font-medium mb-3 flex items-center">
                    {{ $job->company_name }} 
                    <span class="w-1 h-1 bg-gray-300 rounded-full mx-2"></span> 
                    <span class="text-[#9CA3AF] font-normal">{{ $job->type }}</span>
                </p>

                {{-- Badges --}}
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-md text-[11px] font-semibold bg-gray-50 text-gray-600 border border-gray-100 group-hover:bg-white group-hover:border-orange-100 group-hover:text-orange-600 transition-colors">
                        <svg class="w-3 h-3 mr-1 text-gray-400 group-hover:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $job->location }}
                    </span>
                    <span class="inline-flex items-center px-2 py-1 rounded-md text-[11px] font-semibold bg-gray-50 text-gray-600 border border-gray-100 group-hover:bg-white group-hover:border-green-100 group-hover:text-green-600 transition-colors">
                        <svg class="w-3 h-3 mr-1 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $job->salary_range }}
                    </span>
                    <span class="inline-flex items-center text-[10px] text-[#B2B2B2] font-semibold ml-auto md:ml-0 pt-1 md:pt-0">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $job->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            {{-- Arrow Action (Desktop) --}}
            <div class="hidden md:flex w-8 h-8 rounded-full bg-gray-50 items-center justify-center text-[#FF8C42] group-hover:bg-[#2D3436] group-hover:text-white transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>
    </a>
@empty
    {{-- EMPTY STATE --}}
    <div class="bg-white p-10 rounded-[20px] flex flex-col items-center justify-center text-center shadow-sm border border-gray-100">
        <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-4 relative">
            <svg class="w-10 h-10 text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-[#2D3436] mb-1">No jobs found</h3>
        <p class="text-[#636E72] max-w-xs mx-auto leading-relaxed text-sm">
            Try adjusting your search keywords or filters.
        </p>
    </div>
@endforelse

{{-- PAGINATION --}}
<div class="mt-8 pagination-wrapper flex justify-center">
    {{ $jobs->onEachSide(1)->appends(request()->query())->links('vendor.pagination.uc-pagination') }}
</div>