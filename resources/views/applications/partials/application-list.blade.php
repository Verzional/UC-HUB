<div class="flex justify-between items-end mb-6 border-b border-gray-100 pb-2">
    <h2 class="text-xl font-bold text-[#2D3436]">
        All Applications <span class="ml-2 text-sm font-normal text-[#636E72] bg-white px-3 py-1 rounded-full shadow-sm border border-gray-100">{{ $applications->total() }}</span>
    </h2>
</div>

@if ($applications->isEmpty())
    {{-- Empty State Professional --}}
    <div class="bg-white p-12 rounded-[24px] flex flex-col items-center justify-center text-center shadow-[0_5px_20px_rgba(0,0,0,0.03)] border border-gray-100">
        <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-6 relative">
            <div class="absolute inset-0 bg-[#FF8C42] opacity-10 rounded-full animate-pulse"></div>
            <svg class="w-10 h-10 text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-[#2D3436] mb-2">No applications found</h3>
        <p class="text-[#636E72] max-w-sm mx-auto leading-relaxed">
            We couldn't find any applications matching your filters. Try adjusting your search criteria.
        </p>
    </div>
@else
    <div class="grid grid-cols-1 gap-5">
        @foreach ($applications as $app)
            @php
                $badgeColor = match ($app->status) {
                    'Diterima' => 'bg-[#4CD964]',
                    'Ditinjau' => 'bg-[#B8860B]',
                    'Wawancara' => 'bg-[#5856D6]',
                    'Ditolak' => 'bg-[#FF3B30]',
                    default => 'bg-[#636E72]',
                };
                
                // Status Badge Logic (Refined)
                if($app->status == 'Ditinjau') {
                    $badgeClass = "bg-[#FFF9C4] text-[#FBC02D] border border-[#FFF176]";
                } else {
                    $badgeClass = "$badgeColor text-white shadow-md shadow-$badgeColor/20";
                }
            @endphp

            {{-- CARD ITEM --}}
            <div onclick="openDetailModal({{ json_encode($app) }})"
                class="group bg-white rounded-[24px] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-[0_15px_30px_rgba(255,140,66,0.1)] cursor-pointer transition-all duration-300 hover:-translate-y-1 relative overflow-hidden border border-transparent hover:border-orange-100">
                
                {{-- Accent Gradient Line (Left) --}}
                <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-[#FF8C42] to-[#FF3E8D] opacity-0 group-hover:opacity-100 transition-opacity"></div>

                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                    {{-- Logo --}}
                    <div class="w-16 h-16 rounded-2xl bg-gray-50 border border-gray-100 p-2 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                        <img src="{{ $app->company->logo_url ?? '' }}" alt="Logo" class="w-full h-full object-contain">
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col md:flex-row justify-between md:items-center gap-2 mb-2">
                            <h3 class="text-lg font-bold text-[#2D3436] group-hover:text-[#FF8C42] transition-colors truncate">
                                {{ $app->job->title ?? 'Job Title Unavailable' }}
                            </h3>
                            
                            {{-- Status Badge --}}
                            <div class="px-4 py-1.5 rounded-full font-bold text-[11px] uppercase tracking-wider {{ $badgeClass }} flex-shrink-0 w-fit">
                                {{ $app->status }}
                            </div>
                        </div>

                        <p class="text-[#2D3436] font-medium text-sm mb-3">
                            {{ $app->company->name ?? 'Company' }} <span class="text-gray-300 mx-1">•</span> <span class="text-[#636E72]">{{ $app->job->type ?? '' }}</span>
                        </p>

                        <div class="flex items-center justify-between border-t border-gray-50 pt-3 mt-1">
                            <div class="flex items-center text-xs text-[#636E72] bg-gray-50 px-2 py-1 rounded-md">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $app->job->location ?? 'Location' }}
                            </div>
                            
                            <div class="text-[10px] font-bold text-[#B2B2B2] flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Applied {{ \Carbon\Carbon::parse($app->applied_date)->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="mt-10 flex justify-center pagination-wrapper">
        {{ $applications->appends(request()->query())->links('pagination::tailwind') }}
    </div>
@endif