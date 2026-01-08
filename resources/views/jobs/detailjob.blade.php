@extends('layouts.app')

@section('content')

    {{-- STYLE CUSTOM --}}
    <style>
        .tab-pane {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            transform: translateY(10px);
            display: none;
        }
        .tab-pane.active {
            opacity: 1;
            transform: translateY(0);
            display: block;
        }
        .tab-pane.fading-out {
            opacity: 0;
            transform: translateY(-10px);
        }
        /* Hilangkan scrollbar agar rapi */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .radio-indicator div { transition: all 0.2s ease; }
    </style>

    {{-- 
        PERBAIKAN JARAK NAVBAR: 
        Diubah jadi pt-4 (sebelumnya pt-10) biar konten lebih naik ke atas.
    --}}
    <div class="container mx-auto px-4 md:px-20 pt-4 pb-10 font-poppins relative">

        {{-- BACK BUTTON --}}
        <div class="mb-4"> {{-- Margin bawah dikurangi dikit --}}
            <a href="{{ route('jobs.index') }}"
                class="inline-flex items-center text-[#636E72] font-semibold hover:text-[#FF8C42] transition text-sm group">
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center mr-3 shadow-sm border border-gray-100 group-hover:border-orange-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                Back to Jobs
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">

            {{-- ================= KONTEN UTAMA (KIRI) ================= --}}
            <div class="w-full lg:w-[70%]">

                {{-- JOB HEADER CARD --}}
                <div class="bg-white rounded-[24px] p-6 md:p-8 shadow-[0_5px_25px_rgba(0,0,0,0.03)] border border-transparent mb-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-bl-[100px] -z-0 opacity-50"></div>

                    <div class="relative z-10">
                        {{-- ROW 1: COMPANY & FAVORITE --}}
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-white border border-gray-100 p-1 flex items-center justify-center shadow-sm">
                                    <img src="{{ $job->company->logo_url }}" alt="{{ $job->company->name }}" class="w-full h-full object-contain rounded-full">
                                </div>
                                <span class="text-[#636E72] font-bold text-sm tracking-wide">{{ $job->company->name }}</span>
                            </div>

                            {{-- TOMBOL FAVORITE (POJOK KANAN ATAS) --}}
                            <button id="favoriteBtn" onclick="toggleFavorite('{{ $job->id }}')"
                                class="w-9 h-9 rounded-full bg-white border border-gray-100 flex items-center justify-center transition hover:border-[#FF8C42] hover:text-[#FF8C42] shadow-sm {{ $isFavorited ? 'text-[#FF8C42] border-[#FF8C42]' : 'text-gray-300' }}">
                                <svg id="favoriteIcon" class="w-5 h-5 transition-transform duration-200 hover:scale-110"
                                    fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>

                        {{-- ROW 2: TITLE --}}
                        <h1 class="text-2xl md:text-3xl font-extrabold text-[#2D3436] leading-tight mb-4">{{ $job->title }}</h1>

                        {{-- ROW 3: METADATA --}}
                        <div class="flex flex-wrap gap-2 mb-6">
                            <div class="flex items-center px-3 py-1.5 bg-gray-50 rounded-lg border border-gray-100 text-xs font-medium text-[#2D3436]">
                                <svg class="w-3.5 h-3.5 text-[#FF8C42] mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $job->location }}
                            </div>
                            <div class="flex items-center px-3 py-1.5 bg-gray-50 rounded-lg border border-gray-100 text-xs font-medium text-[#2D3436]">
                                <svg class="w-3.5 h-3.5 text-[#FF8C42] mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $job->type }}
                            </div>
                            <div class="flex items-center px-3 py-1.5 bg-green-50 rounded-lg border border-green-100 text-xs font-medium text-green-700">
                                <svg class="w-3.5 h-3.5 text-green-600 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $job->salary_range }}
                            </div>
                        </div>

                        {{-- ROW 4: APPLY BUTTON (DIKECILIN UKURANNYA) --}}
                        <div>
                            <button onclick="checkAuthAndOpenApply()"
                                class="w-full md:w-auto bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold text-sm py-2.5 px-8 rounded-full shadow-md shadow-orange-200 hover:shadow-lg hover:-translate-y-0.5 transform transition-all duration-300 flex items-center justify-center gap-2">
                                <span>Apply Now</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- TABS NAVIGATION --}}
                <div class="flex gap-8 border-b border-gray-200 mb-6 px-2">
                    <button onclick="switchTab('details')" id="tab-details" class="pb-3 text-[#2D3436] font-bold border-b-[3px] border-[#FF8C42] transition-all duration-300 text-sm md:text-base">Job Details</button>
                    <button onclick="switchTab('company')" id="tab-company" class="pb-3 text-[#B2B2B2] font-medium hover:text-[#2D3436] transition-all duration-300 text-sm md:text-base border-b-[3px] border-transparent">About Company</button>
                </div>

                {{-- CONTENT AREA --}}
                <div class="relative min-h-[300px]">
                    
                    {{-- 1. JOB DETAILS CONTENT --}}
                    <div id="content-details" class="tab-pane active bg-white p-8 md:p-10 rounded-[24px] shadow-[0_5px_20px_rgba(0,0,0,0.03)] text-[#2D3436]">
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-3 flex items-center">
                                <span class="w-1.5 h-6 bg-[#FF8C42] rounded-full mr-3"></span> Description
                            </h3>
                            <p class="text-[#636E72] leading-7 text-sm md:text-base whitespace-pre-line text-justify">{{ $job->description }}</p>
                        </div>

                        @if (!empty($job->responsibilities))
                            <div class="mb-8">
                                <h3 class="text-lg font-bold mb-3 flex items-center">
                                    <span class="w-1.5 h-6 bg-[#FF8C42] rounded-full mr-3"></span> Responsibilities
                                </h3>
                                <ul class="space-y-3">
                                    @foreach ($job->responsibilities as $item)
                                        <li class="flex items-start text-[#636E72] leading-relaxed text-sm md:text-base">
                                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (!empty($job->qualifications))
                            <div class="mb-8">
                                <h3 class="text-lg font-bold mb-3 flex items-center">
                                    <span class="w-1.5 h-6 bg-[#FF8C42] rounded-full mr-3"></span> Qualifications
                                </h3>
                                <ul class="space-y-3">
                                    @foreach ($job->qualifications as $item)
                                        <li class="flex items-start text-[#636E72] leading-relaxed text-sm md:text-base">
                                            <div class="w-1.5 h-1.5 bg-[#2D3436] rounded-full mr-3 mt-2 flex-shrink-0"></div>
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (!empty($job->benefits))
                            <div class="mb-8">
                                <h3 class="text-lg font-bold mb-3 flex items-center">
                                    <span class="w-1.5 h-6 bg-[#FF8C42] rounded-full mr-3"></span> Benefits
                                </h3>
                                <ul class="space-y-3">
                                    @foreach ($job->benefits as $item)
                                        <li class="flex items-start text-[#636E72] leading-relaxed text-sm md:text-base">
                                            <span class="mr-3 mt-1.5 w-1.5 h-1.5 bg-[#2D3436] rounded-full flex-shrink-0"></span>
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- SECONDARY APPLY BUTTON --}}
                        <div class="mt-10 pt-8 border-t border-gray-100">
                            <div class="flex flex-col md:flex-row items-center justify-between gap-4 bg-orange-50 p-6 rounded-[20px]">
                                <div>
                                    <h4 class="font-bold text-[#2D3436]">Interested in this job?</h4>
                                    <p class="text-xs text-[#636E72] mt-1">Don't miss this opportunity.</p>
                                </div>
                                <button onclick="checkAuthAndOpenApply()" class="bg-[#2D3436] text-white font-bold py-2.5 px-8 rounded-full shadow-lg hover:shadow-xl hover:bg-black transition duration-200 text-sm w-full md:w-auto">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 2. ABOUT COMPANY CONTENT --}}
                    <div id="content-company" class="tab-pane bg-white p-8 md:p-10 rounded-[24px] shadow-[0_5px_20px_rgba(0,0,0,0.03)] text-[#2D3436]">
                        <div class="flex items-start gap-5 mb-8">
                            <img src="{{ $job->company->logo_url }}" class="w-16 h-16 rounded-full border border-gray-100 p-1 object-contain bg-white">
                            <div>
                                <h3 class="text-xl font-bold text-[#2D3436]">{{ $job->company->name }}</h3>
                                <p class="text-sm text-[#636E72] mt-1">{{ $job->company->industry ?? 'Technology' }}</p>
                                @if($job->company->website_url)
                                    <a href="{{ $job->company->website_url }}" target="_blank" class="inline-flex items-center text-[#FF8C42] font-bold text-xs mt-2 hover:underline">
                                        Visit Website <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50/50">
                                <p class="text-[10px] text-[#B2B2B2] font-bold uppercase mb-1">Headquarters</p>
                                <p class="text-sm font-bold text-[#2D3436]">{{ $job->company->location_headquarters ?? 'Jakarta, Indonesia' }}</p>
                            </div>
                            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50/50">
                                <p class="text-[10px] text-[#B2B2B2] font-bold uppercase mb-1">Industry</p>
                                <p class="text-sm font-bold text-[#2D3436]">{{ $job->company->industry ?? 'Technology' }}</p>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-bold text-base mb-3">About Us</h4>
                            <p class="text-[#636E72] text-sm leading-relaxed whitespace-pre-line text-justify border-l-4 border-orange-200 pl-4">
                                {{ $job->company->description ?? 'No description available.' }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ================= SIDEBAR (KANAN) ================= --}}
<div class="w-full lg:w-[35%]">
    
    <div class="sticky top-24 space-y-8"> {{-- Container Sticky untuk Sidebar --}}

        {{-- 1. JOB MATCH SCORE CARD (FITUR BARU) --}}
        @auth
            @if($hasSkillsData)
                <div class="bg-white rounded-[24px] p-6 shadow-[0_5px_30px_rgba(0,0,0,0.04)] border border-gray-100 relative overflow-hidden">
                    
                    {{-- Decorative Background --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#FF8C42] to-[#FF3E8D]"></div>

                    <h2 class="text-lg font-bold text-[#2D3436] mb-4">Profile Match</h2>

                    <div class="flex items-center gap-5 mb-6">
                        {{-- Circular Progress (CSS Only) --}}
                        <div class="relative w-20 h-20 flex-shrink-0">
                            <svg class="w-full h-full transform -rotate-90">
                                <circle cx="40" cy="40" r="36" stroke="#F3F4F6" stroke-width="8" fill="none"></circle>
                                <circle cx="40" cy="40" r="36" stroke="{{ $matchPercent >= 70 ? '#4CD964' : ($matchPercent >= 40 ? '#FFCC00' : '#FF3B30') }}" stroke-width="8" fill="none" stroke-dasharray="226" stroke-dashoffset="{{ 226 - (226 * $matchPercent / 100) }}" style="transition: stroke-dashoffset 1s ease-out; stroke-linecap: round;"></circle>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center flex-col">
                                <span class="text-lg font-extrabold text-[#2D3436]">{{ $matchPercent }}%</span>
                            </div>
                        </div>

                        <div>
                            @if($matchPercent >= 80)
                                <p class="text-sm font-bold text-[#4CD964]">Excellent Match!</p>
                                <p class="text-xs text-[#636E72] leading-tight mt-1">Your profile fits this job perfectly.</p>
                            @elseif($matchPercent >= 50)
                                <p class="text-sm font-bold text-[#FFCC00]">Good Match</p>
                                <p class="text-xs text-[#636E72] leading-tight mt-1">You have most of the required skills.</p>
                            @else
                                <p class="text-sm font-bold text-[#FF3B30]">Low Match</p>
                                <p class="text-xs text-[#636E72] leading-tight mt-1">You might need to upskill for this role.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Skills Breakdown --}}
                    <div class="space-y-3">
                        <p class="text-xs font-bold text-[#636E72] uppercase tracking-wider mb-2">Skills Analysis</p>
                        
                        {{-- Matched Skills --}}
                        @foreach($matchingSkills as $skill)
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center text-[#4CD964]">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span class="text-[#2D3436] font-medium">{{ $skill->name }}</span>
                                </div>
                            </div>
                        @endforeach

                        {{-- Missing Skills --}}
                        @foreach($missingSkills as $skill)
                            <div class="flex items-center justify-between text-sm opacity-60 hover:opacity-100 transition">
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </div>
                                    <span class="text-[#636E72]">{{ $skill->name }}</span>
                                </div>
                                <span class="text-[10px] text-gray-400 bg-gray-50 px-2 py-0.5 rounded-md">Missing</span>
                            </div>
                        @endforeach
                    </div>

                    @if($missingSkills->count() > 0)
                        <div class="mt-5 p-3 bg-blue-50 rounded-xl flex gap-3 items-start">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-blue-700 leading-relaxed">
                                Tip: You can edit your profile to add missing skills if you actually possess them.
                                <a href="{{ route('user.account') }}" class="font-bold underline hover:text-blue-900">Edit Profile</a>
                            </p>
                        </div>
                    @endif
                </div>
            @endif
        @endauth

        {{-- 2. SIMILAR JOBS (EXISTING CODE) --}}
        <div>
            <h2 class="text-lg font-bold text-[#2D3436] mb-5 pl-1">Similar Jobs</h2>
            <div class="flex flex-col gap-4">
                @forelse($similarJobs as $simJob)
                    {{-- (Isi kode similar jobs Anda yg lama tetap disini) --}}
                    <a href="{{ route('jobs.show', $simJob->id) }}"
                        class="bg-white p-4 rounded-[18px] shadow-sm hover:shadow-md transition border border-transparent hover:border-orange-100 group relative">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center overflow-hidden border border-gray-100 p-1 flex-shrink-0">
                                <img src="{{ $simJob->company->logo_url }}" alt="{{ $simJob->company->name }}" class="w-full h-full object-contain rounded-full">
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-bold text-[#2D3436] group-hover:text-[#FF8C42] transition text-sm leading-tight truncate">
                                    {{ $simJob->title }}
                                </h3>
                                <h3 class="text-[10px] text-[#636E72] truncate">{{ $simJob->company->name }}</h3>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-[10px] text-[#636E72] bg-gray-50 px-2 py-1 rounded-md">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <h3>{{ $simJob->location }}</h3>
                            </div>
                            <span class="text-xs text-[#FF8C42] font-bold opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-2 group-hover:translate-x-0">
                                View &rarr;
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="text-[#636E72] text-xs text-center py-6 bg-white rounded-xl border border-dashed border-gray-200">
                        No similar jobs found.
                    </div>
                @endforelse
            </div>
        </div>

    </div> {{-- End Sticky Container --}}
</div>
        </div>
    </div>

    {{-- ================================================================= --}}
    {{-- MODALS SECTION - FIXED UPLOAD TRIGGER                             --}}
    {{-- ================================================================= --}}

    {{-- AUTH MODAL --}}
    <div id="authModal" class="fixed inset-0 z-[1000] hidden"><div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeAuthModal()"></div><div class="absolute inset-0 flex items-center justify-center p-4"><div class="bg-white rounded-[24px] shadow-2xl w-full max-w-sm p-8 relative text-center"><button onclick="closeAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-[#FF8C42]"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button><div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-5 text-[#FF8C42]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg></div><h3 class="text-2xl font-bold text-[#2D3436] mb-2">Login Required</h3><p class="text-[#636E72] mb-6 text-sm">Please login to apply.</p><a href="{{ route('login') }}" class="block w-full py-3 rounded-full bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold mb-3 shadow-md hover:shadow-lg transition">Login</a><a href="{{ route('register') }}" class="block w-full py-3 rounded-full border border-[#FF8C42] text-[#FF8C42] font-bold hover:bg-orange-50 transition">Register</a></div></div></div>

    {{-- ERROR MODAL --}}
    <div id="errorModal" class="fixed inset-0 z-[1100] hidden"><div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeErrorModal()"></div><div class="absolute inset-0 flex items-center justify-center p-4"><div class="bg-white rounded-[24px] shadow-2xl w-full max-w-xs p-6 relative text-center"><div class="w-14 h-14 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 text-[#FF3B30]"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div><h3 class="text-lg font-bold text-[#2D3436] mb-1">Attention</h3><p id="errorMessage" class="text-[#636E72] text-sm mb-6">Error message here.</p><button onclick="closeErrorModal()" class="w-full py-2.5 rounded-full bg-[#2D3436] text-white font-bold text-sm hover:bg-black transition">OK</button></div></div></div>

    {{-- LOADING MODAL --}}
    <div id="loadingModal" class="fixed inset-0 z-[1200] hidden flex items-center justify-center"><div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div><div class="bg-white rounded-[20px] p-6 flex flex-col items-center justify-center shadow-2xl z-20 relative animate-bounce-small"><div class="w-12 h-12 border-4 border-orange-100 border-t-[#FF8C42] rounded-full animate-spin mb-4"></div><p class="text-[#2D3436] font-bold text-base">Uploading...</p></div></div>

    {{-- PDF PREVIEW MODAL (FIXED HEADER: TOMBOL X DI ATAS RAAPI) --}}
    <div id="pdfModal" class="fixed inset-0 z-[1500] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closePdfModal()"></div>
        <div class="bg-white w-full max-w-4xl h-[85vh] relative rounded-2xl overflow-hidden z-10 flex flex-col shadow-2xl">
            {{-- HEADER PDF --}}
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-white">
                <h3 class="font-bold text-lg text-[#2D3436]">Document Preview</h3>
                <button onclick="closePdfModal()" class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-red-50 hover:text-red-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            {{-- CONTENT PDF --}}
            <div class="flex-1 bg-gray-100 relative">
                <iframe id="pdfViewerFrame" class="w-full h-full border-0"></iframe>
            </div>
        </div>
    </div>

    {{-- APPLY MODAL (FIXED UPLOAD) --}}
    @auth
    <div id="applyModal" class="fixed inset-0 z-[999] hidden">
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm transition-opacity" onclick="closeApplyModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-[24px] shadow-2xl w-full max-w-lg p-8 relative transform transition-all scale-100">
                <div id="modalHeader">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] flex items-center justify-center text-white font-bold" id="stepNumber">1</div>
                            <h3 class="font-bold text-lg text-[#2D3436]" id="stepTitle">Step 1: Confirm Your Profile</h3>
                        </div>
                        <button onclick="closeApplyModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    <p class="text-xs text-[#636E72] ml-12 mb-6">Applying for: <span class="font-bold">{{ $job->title }}</span></p>
                    <hr class="border-gray-100 mb-6">
                </div>

                <form id="applyForm" enctype="multipart/form-data">
                    @csrf
                    {{-- STEP 1 --}}
                    <div id="step1Content">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div><label class="block text-xs font-bold text-[#636E72] mb-2">Full Name</label><input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full p-3 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:border-[#FF8C42] transition text-[#2D3436]"></div>
                            <div><label class="block text-xs font-bold text-[#636E72] mb-2">Email</label><input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full p-3 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:border-[#FF8C42] transition text-[#2D3436]" readonly></div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div><label class="block text-xs font-bold text-[#636E72] mb-2">Phone</label><input type="text" name="phone" value="{{ Auth::user()->phone_number }}" class="w-full p-3 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:border-[#FF8C42] transition text-[#2D3436]"></div>
                            <div><label class="block text-xs font-bold text-[#636E72] mb-2">Major</label><input type="text" name="major" value="{{ Auth::user()->major }}" class="w-full p-3 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:border-[#FF8C42] transition text-[#2D3436]"></div>
                        </div>
                        <div class="flex gap-4">
                            <button type="button" onclick="closeApplyModal()" class="flex-1 py-3 rounded-full border border-gray-300 text-[#636E72] font-bold hover:bg-gray-50 transition">Cancel</button>
                            <button type="button" onclick="validateAndGoStep2()" class="flex-1 py-3 rounded-full bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold shadow-md hover:shadow-lg transition">Continue</button>
                        </div>
                    </div>

                    {{-- STEP 2 --}}
                    <div id="step2Content" class="hidden">
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-[#2D3436] mb-2">Curriculum Vitae <span class="text-red-500">*</span></label>
                            <input type="hidden" id="cv_source" name="cv_source" value=""> 
                            <div class="flex flex-col gap-2">
                                @if(Auth::user()->saved_cv_name)
                                <div id="cv_opt_saved" onclick="selectSource('cv', 'saved')" class="p-3 border border-gray-200 rounded-[15px] cursor-pointer hover:border-[#FF8C42] transition flex justify-between items-center group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center group-hover:border-[#FF8C42] radio-indicator"><div class="w-2 h-2 rounded-full bg-[#FF8C42] hidden"></div></div>
                                        <div><p class="text-xs font-bold text-[#2D3436]">Use Saved CV</p><p class="text-[10px] text-[#636E72]">{{ Str::limit(Auth::user()->saved_cv_name, 30) }}</p></div>
                                    </div>
                                    <button type="button" onclick="event.stopPropagation(); viewPdf('{{ asset('storage/documents/' . Auth::user()->saved_cv_name) }}')" class="p-2 hover:bg-gray-100 rounded-full" title="View"><svg class="w-4 h-4 text-[#636E72]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                </div>
                                @endif

                                <div id="cv_opt_upload" onclick="triggerClick('cv_file')" class="p-3 border border-gray-200 rounded-[15px] cursor-pointer hover:border-[#FF8C42] transition flex justify-between items-center group relative">
                                    <div class="flex items-center gap-3 w-full">
                                        <div class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center group-hover:border-[#FF8C42] radio-indicator flex-shrink-0"><div class="w-2 h-2 rounded-full bg-[#FF8C42] hidden"></div></div>
                                        <div class="w-full relative">
                                            <p class="text-xs font-bold text-[#2D3436] mb-1">Upload New CV</p>
                                            <div class="flex gap-2 items-center">
                                                <div class="flex-1 py-2 px-3 bg-gray-50 border border-dashed border-gray-300 rounded-lg text-[10px] text-[#636E72] hover:bg-white text-center truncate">
                                                    <span id="cv_filename_display">Click here to choose file...</span>
                                                </div>
                                                <input type="file" id="cv_file" name="cv_file" accept=".pdf" class="hidden" onchange="handleFileSelect(this, 'cv')">
                                                <button type="button" id="btn_view_upload_cv" onclick="event.stopPropagation(); viewUploadedPdf('cv_file')" class="hidden p-2 hover:bg-gray-100 rounded-full" title="View Uploaded">
                                                    <svg class="w-4 h-4 text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-[#2D3436] mb-2">Portfolio <span class="text-red-500">*</span></label>
                            <input type="hidden" id="portfolio_source" name="portfolio_source" value="">
                            <div class="flex flex-col gap-2">
                                @if(Auth::user()->saved_portfolio_name)
                                <div id="portfolio_opt_saved" onclick="selectSource('portfolio', 'saved')" class="p-3 border border-gray-200 rounded-[15px] cursor-pointer hover:border-[#FF8C42] transition flex justify-between items-center group">
                                    <div class="flex items-center gap-3"><div class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center group-hover:border-[#FF8C42] radio-indicator"><div class="w-2 h-2 rounded-full bg-[#FF8C42] hidden"></div></div><div><p class="text-xs font-bold text-[#2D3436]">Use Saved Portfolio</p><p class="text-[10px] text-[#636E72]">{{ Str::limit(Auth::user()->saved_portfolio_name, 30) }}</p></div></div>
                                    <button type="button" onclick="event.stopPropagation(); viewPdf('{{ asset('storage/documents/' . Auth::user()->saved_portfolio_name) }}')" class="p-2 hover:bg-gray-100 rounded-full"><svg class="w-4 h-4 text-[#636E72]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                </div>
                                @endif
                                <div id="portfolio_opt_upload" onclick="triggerClick('portfolio_file')" class="p-3 border border-gray-200 rounded-[15px] cursor-pointer hover:border-[#FF8C42] transition flex justify-between items-center group relative">
                                    <div class="flex items-center gap-3 w-full">
                                        <div class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center group-hover:border-[#FF8C42] radio-indicator flex-shrink-0"><div class="w-2 h-2 rounded-full bg-[#FF8C42] hidden"></div></div>
                                        <div class="w-full relative"><p class="text-xs font-bold text-[#2D3436] mb-1">Upload New Portfolio</p>
                                            <div class="flex gap-2 items-center">
                                                <div class="flex-1 py-2 px-3 bg-gray-50 border border-dashed border-gray-300 rounded-lg text-[10px] text-[#636E72] hover:bg-white text-center truncate">
                                                    <span id="portfolio_filename_display">Click here to choose file...</span>
                                                </div>
                                                <input type="file" id="portfolio_file" name="portfolio_file" accept=".pdf" class="hidden" onchange="handleFileSelect(this, 'portfolio')">
                                                <button type="button" id="btn_view_upload_portfolio" onclick="event.stopPropagation(); viewUploadedPdf('portfolio_file')" class="hidden p-2 hover:bg-gray-100 rounded-full"><svg class="w-4 h-4 text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-[#2D3436] mb-2">Cover Letter <span class="text-[#636E72] font-normal text-xs">(Optional)</span></label>
                            <div onclick="triggerClick('cover_letter')" class="p-3 border border-gray-200 rounded-[15px] bg-gray-50 cursor-pointer hover:border-[#FF8C42] transition">
                                <div class="flex gap-2 items-center justify-center">
                                    <div class="text-xs text-[#636E72] flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <span id="cl_filename_display">Click to Upload PDF</span>
                                    </div>
                                    <input type="file" id="cover_letter" name="cover_letter" accept=".pdf" class="hidden" onchange="handleFileSelect(this, 'cl')">
                                    <button type="button" id="btn_view_cl" onclick="event.stopPropagation(); viewUploadedPdf('cover_letter')" class="hidden p-2 hover:bg-gray-200 rounded-full"><svg class="w-4 h-4 text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" onclick="goToStep1()" class="flex-1 py-3 rounded-full border border-gray-300 text-[#636E72] font-bold hover:bg-gray-50 transition">Back</button>
                            <button type="button" id="btnSubmit" onclick="submitApplication()" class="flex-1 py-3 rounded-full bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold shadow-md hover:shadow-lg transition">Submit Application</button>
                        </div>
                    </div>
                </form>

                <div id="step3Content" class="hidden text-center py-6">
                    <div class="w-20 h-20 bg-[#4CD964] rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg text-white animate-bounce"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                    <h3 class="text-2xl font-bold text-[#2D3436] mb-2">Application Submitted!</h3>
                    <p class="text-[#636E72] mb-8 px-4 text-sm">Good luck! You can track your application status in the 'My Applications' menu.</p>
                    <button onclick="closeApplyModal()" class="bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold py-3 px-12 rounded-full shadow-md hover:shadow-lg transition">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endauth

@endsection

@push('scripts')
<script>
    // --- STICKY HEADER LOGIC ---
    document.getElementById('stickyHeader')?.remove(); // Pastikan tidak ada duplikat

    // --- TABS SYSTEM ---
    function switchTab(tab) {
        const btnDetails = document.getElementById('tab-details');
        const btnCompany = document.getElementById('tab-company');
        const contentDetails = document.getElementById('content-details');
        const contentCompany = document.getElementById('content-company');

        if(tab === 'details') {
            btnDetails.classList.replace('border-transparent', 'border-[#FF8C42]');
            btnDetails.classList.replace('text-[#B2B2B2]', 'text-[#2D3436]');
            btnCompany.classList.replace('border-[#FF8C42]', 'border-transparent');
            btnCompany.classList.replace('text-[#2D3436]', 'text-[#B2B2B2]');
            contentCompany.classList.add('fading-out');
            setTimeout(() => {
                contentCompany.classList.add('hidden');
                contentCompany.classList.remove('fading-out', 'active');
                contentDetails.classList.remove('hidden');
                setTimeout(() => contentDetails.classList.add('active'), 50);
            }, 300);
        } else {
            btnCompany.classList.replace('border-transparent', 'border-[#FF8C42]');
            btnCompany.classList.replace('text-[#B2B2B2]', 'text-[#2D3436]');
            btnDetails.classList.replace('border-[#FF8C42]', 'border-transparent');
            btnDetails.classList.replace('text-[#2D3436]', 'text-[#B2B2B2]');
            contentDetails.classList.add('fading-out');
            setTimeout(() => {
                contentDetails.classList.add('hidden');
                contentDetails.classList.remove('fading-out', 'active');
                contentCompany.classList.remove('hidden');
                setTimeout(() => contentCompany.classList.add('active'), 50);
            }, 300);
        }
    }

    // --- AUTH & MODAL ---
    function checkAuthAndOpenApply() { @guest document.getElementById('authModal').classList.remove('hidden'); @else openApplyModal(); @endguest }
    function closeAuthModal() { document.getElementById('authModal').classList.add('hidden'); }
    
    // --- APPLY MODAL LOGIC ---
    const modal=document.getElementById('applyModal'),step1=document.getElementById('step1Content'),step2=document.getElementById('step2Content'),step3=document.getElementById('step3Content'),modalHeader=document.getElementById('modalHeader'),stepTitle=document.getElementById('stepTitle'), stepNumber=document.getElementById('stepNumber');
    function openApplyModal(){modal.classList.remove('hidden');goToStep1();}
    function closeApplyModal(){modal.classList.add('hidden');}
    function goToStep1(){modalHeader.style.display='block';stepTitle.innerText="Step 1: Confirm Profile";stepNumber.innerText="1";step1.classList.remove('hidden');step2.classList.add('hidden');step3.classList.add('hidden');}
    function validateAndGoStep2(){
        const n=document.querySelector('input[name="name"]').value,p=document.querySelector('input[name="phone"]').value,m=document.querySelector('input[name="major"]').value;
        if(!n||!p||!m){showError("Please fill profile.");return;}
        stepTitle.innerText="Step 2: Attach Documents";stepNumber.innerText="2";step1.classList.add('hidden');step2.classList.remove('hidden');
    }

    // --- FILE HANDLING (FIXED UPLOAD) ---
    function triggerClick(elemId) {
        document.getElementById(elemId).click();
    }

    function selectSource(type, source) {
        const inputId = type + '_source';
        document.getElementById(inputId).value = source;
        const savedBox = document.getElementById(type + '_opt_saved');
        const uploadBox = document.getElementById(type + '_opt_upload');
        
        if(savedBox) {
            savedBox.classList.remove('border-[#FF8C42]','bg-orange-50');
            savedBox.classList.add('border-gray-200');
            savedBox.querySelector('.radio-indicator div').classList.add('hidden');
        }
        uploadBox.classList.remove('border-[#FF8C42]','bg-orange-50');
        uploadBox.classList.add('border-gray-200');
        uploadBox.querySelector('.radio-indicator div').classList.add('hidden');

        if(source === 'saved') {
            savedBox.classList.add('border-[#FF8C42]','bg-orange-50');
            savedBox.classList.remove('border-gray-200');
            savedBox.querySelector('.radio-indicator div').classList.remove('hidden');
        } else {
            uploadBox.classList.add('border-[#FF8C42]','bg-orange-50');
            uploadBox.classList.remove('border-gray-200');
            uploadBox.querySelector('.radio-indicator div').classList.remove('hidden');
        }
    }

    function handleFileSelect(input, type) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // VALIDASI 5MB
            if (file.size > 5 * 1024 * 1024) {
                showError("File too large! Max 5MB.");
                input.value = ""; // Reset input
                return;
            }

            const fileName = file.name;
            
            // Auto Select 'Upload'
            if (type === 'cv' || type === 'portfolio') selectSource(type, 'upload');

            if (type === 'cv') {
                const display = document.getElementById('cv_filename_display');
                display.innerText = fileName;
                display.classList.add('text-[#2D3436]', 'font-bold');
                document.getElementById('btn_view_upload_cv').classList.remove('hidden');
            } else if (type === 'portfolio') {
                const display = document.getElementById('portfolio_filename_display');
                display.innerText = fileName;
                display.classList.add('text-[#2D3436]', 'font-bold');
                document.getElementById('btn_view_upload_portfolio').classList.remove('hidden');
            } else if (type === 'cl') {
                const display = document.getElementById('cl_filename_display');
                display.innerText = fileName;
                display.classList.add('text-[#2D3436]', 'font-bold');
                document.getElementById('btn_view_cl').classList.remove('hidden');
            }
        }
    }

    function viewPdf(u){document.getElementById('pdfModal').classList.remove('hidden');document.getElementById('pdfViewerFrame').src=u;}
    
    function viewUploadedPdf(inputId) {
        const input = document.getElementById(inputId);
        if (input.files && input.files[0]) {
            const fileUrl = URL.createObjectURL(input.files[0]);
            viewPdf(fileUrl);
        }
    }

    function closePdfModal(){document.getElementById('pdfModal').classList.add('hidden');document.getElementById('pdfViewerFrame').src="";}
    function showError(m){document.getElementById('errorMessage').innerText=m;document.getElementById('errorModal').classList.remove('hidden');}
    function closeErrorModal(){document.getElementById('errorModal').classList.add('hidden');}
    
    function submitApplication(){
        const btn=document.getElementById('btnSubmit');
        const originalText=btn.innerText;
        document.getElementById('loadingModal').classList.remove('hidden');
        btn.disabled=true;
        btn.innerText="Processing...";

        const form = document.getElementById('applyForm');
        const formData = new FormData(form);
        
        const cvSource = formData.get('cv_source');
        if(!cvSource) { hideLoad(); showError("Please select a CV source."); return; }
        if(cvSource === 'upload' && !document.getElementById('cv_file').files[0]) { hideLoad(); showError("Please upload a CV file."); return; }
        
        const portoSource = formData.get('portfolio_source');
        if(!portoSource) { hideLoad(); showError("Please select a Portfolio source."); return; }
        if(portoSource === 'upload' && !document.getElementById('portfolio_file').files[0]) { hideLoad(); showError("Please upload a Portfolio file."); return; }

        fetch("{{ route('jobs.apply', $job->id) }}", {method:'POST', body:formData, headers:{'X-Requested-With':'XMLHttpRequest'}})
        .then(r=>r.json().then(d=>({s:r.status,b:d}))).then(res=>{
            hideLoad(); 
            if(res.s===200){modalHeader.style.display='none';step2.classList.add('hidden');step3.classList.remove('hidden');}
            else showError(res.b.message||"Error occurred.");
        }).catch(()=>{ hideLoad(); showError("Network Error."); });

        function hideLoad(){document.getElementById('loadingModal').classList.add('hidden');btn.disabled=false;btn.innerText=originalText;}
    }

    function toggleFavorite(id){
        const btn=document.getElementById('favoriteBtn'); const icon=document.getElementById('favoriteIcon');
        fetch(`/jobs/${id}/favorite`,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'}})
        .then(r=>{if(r.status===401)document.getElementById('authModal').classList.remove('hidden');return r.json()})
        .then(d=>{if(d.is_favorited){btn.classList.add('text-[#FF8C42]','border-[#FF8C42]');btn.classList.remove('text-gray-300');icon.setAttribute('fill','currentColor');}
        else{btn.classList.remove('text-[#FF8C42]','border-[#FF8C42]');btn.classList.add('text-gray-300');icon.setAttribute('fill','none');}});
    }
</script>
@endpush