@extends('layouts.app')

@section('content')
    <div class="bg-[#F9FAFB] min-h-screen font-poppins pb-20">

        {{-- 1. HERO DASHBOARD SECTION --}}
        <div class="relative bg-[#1E1E1E] pt-10 pb-32 overflow-hidden">
            {{-- Background Effects --}}
            <div class="absolute inset-0 bg-[linear-gradient(135deg,#FF8C42_0%,#FF3E8D_100%)] opacity-90"></div>
            <div class="absolute top-[-50%] left-[-20%] w-[800px] h-[800px] bg-white opacity-10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[400px] h-[400px] bg-[#FF8C42] opacity-30 rounded-full blur-[80px] pointer-events-none"></div>

            <div class="container mx-auto px-4 md:px-10 relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-8">
                    {{-- Greeting --}}
                    <div class="text-white">
                        <div class="flex items-center gap-2 mb-2 opacity-90">
                            <span class="bg-white/20 px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm border border-white/10">
                                {{ \Carbon\Carbon::now()->format('l, d F Y') }}
                            </span>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">
                            Welcome back, <br> {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-white/80 text-base mt-3 font-light max-w-lg leading-relaxed">
                            Your dream career is just a few clicks away. Keep your profile updated and start applying!
                        </p>
                    </div>

                    {{-- Quick Action Button --}}
                    <a href="{{ route('jobs.index') }}" class="hidden md:inline-flex items-center bg-white text-[#FF8C42] hover:bg-[#F9FAFB] px-6 py-3 rounded-full text-sm font-bold shadow-[0_10px_20px_rgba(0,0,0,0.1)] transition transform hover:-translate-y-0.5 group">
                        Browse Opportunities
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. DASHBOARD CONTENT (Overlapping) --}}
        <div class="container mx-auto px-4 md:px-10 relative z-20 mt-10">
            
            {{-- STATS GRID (PERBAIKAN DISINI) --}}
            {{-- grid-cols-1 (HP: 1 kolom ke bawah) --}}
            {{-- md:grid-cols-3 (Desktop: 3 kolom ke samping) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                
                {{-- Card 1: Applied --}}
                <a href="{{ route('applications.index') }}" class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 hover:shadow-[0_15px_30px_rgba(0,0,0,0.05)] hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <span class="flex items-center text-[10px] font-bold text-blue-600 bg-white border border-blue-100 px-2 py-1 rounded-full shadow-sm">
                                View Details
                            </span>
                        </div>
                        <div>
                            <p class="text-[#636E72] text-sm font-bold uppercase tracking-wider mb-1">Applied Jobs</p>
                            <h3 class="text-3xl font-extrabold text-[#2D3436]">12</h3>
                        </div>
                    </div>
                </a>

                {{-- Card 2: Interviews --}}
                <a href="{{ route('applications.index') }}?status=Wawancara" class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 hover:shadow-[0_15px_30px_rgba(0,0,0,0.05)] hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-colors shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#636E72] text-sm font-bold uppercase tracking-wider mb-1">Interviews</p>
                            <h3 class="text-3xl font-extrabold text-[#2D3436]">3</h3>
                        </div>
                    </div>
                </a>

                {{-- Card 3: Saved --}}
                <a href="{{ route('jobs.saved') }}" class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 hover:shadow-[0_15px_30px_rgba(0,0,0,0.05)] hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-[#FF8C42] group-hover:bg-[#FF8C42] group-hover:text-white transition-colors shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#636E72] text-sm font-bold uppercase tracking-wider mb-1">Saved Jobs</p>
                            <h3 class="text-3xl font-extrabold text-[#2D3436]">8</h3>
                        </div>
                    </div>
                </a>
            </div>

            {{-- MAIN LAYOUT (2 Columns) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- LEFT CONTENT --}}
                <div class="lg:col-span-2 space-y-8">
                    
                    {{-- Recommended Jobs --}}
                    <div>
                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <h2 class="text-xl font-bold text-[#2D3436]">Recommended for You</h2>
                                <p class="text-sm text-[#636E72] mt-1">Based on your major and preferences</p>
                            </div>
                            <a href="{{ route('jobs.index') }}" class="text-sm font-bold text-[#FF8C42] hover:text-[#FF3E8D] transition flex items-center gap-1">
                                View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>

                        {{-- Job Card 1 --}}
                        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 hover:shadow-[0_10px_30px_rgba(0,0,0,0.05)] transition-all mb-4 group relative overflow-hidden hover:-translate-y-1 cursor-pointer" onclick="window.location='{{ route('jobs.index') }}'">
                            <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-[#FF8C42] to-[#FF3E8D] opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="flex gap-5">
                                <div class="w-16 h-16 rounded-2xl bg-white border border-gray-100 p-2 flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <img src="https://logo.clearbit.com/gojek.com" alt="Gojek" class="w-full h-full object-contain">
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-bold text-[#2D3436] group-hover:text-[#FF8C42] transition-colors">UI/UX Designer Intern</h3>
                                            <p class="text-sm font-medium text-[#636E72] mb-3">Gojek Indonesia</p>
                                            
                                            <div class="flex flex-wrap gap-2">
                                                <span class="px-3 py-1 bg-gray-50 text-gray-600 text-[11px] font-bold rounded-lg border border-gray-100">Jakarta</span>
                                                <span class="px-3 py-1 bg-green-50 text-green-600 text-[11px] font-bold rounded-lg border border-green-100">Full Time</span>
                                            </div>
                                        </div>
                                        <button class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-orange-50 hover:text-[#FF8C42] transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </button>
                                    </div>
                                    <div class="border-t border-gray-50 mt-4 pt-3 flex justify-between items-center text-xs text-[#9CA3AF]">
                                        <span>Posted 2 days ago</span>
                                        <span class="font-bold text-[#2D3436]">IDR 5.000.000 - 8.000.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Job Card 2 --}}
                        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 hover:shadow-[0_10px_30px_rgba(0,0,0,0.05)] transition-all mb-4 group relative overflow-hidden hover:-translate-y-1 cursor-pointer" onclick="window.location='{{ route('jobs.index') }}'">
                            <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-[#FF8C42] to-[#FF3E8D] opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="flex gap-5">
                                <div class="w-16 h-16 rounded-2xl bg-white border border-gray-100 p-2 flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <img src="https://logo.clearbit.com/tokopedia.com" alt="Tokopedia" class="w-full h-full object-contain">
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-bold text-[#2D3436] group-hover:text-[#FF8C42] transition-colors">Frontend Engineer</h3>
                                            <p class="text-sm font-medium text-[#636E72] mb-3">Tokopedia</p>
                                            
                                            <div class="flex flex-wrap gap-2">
                                                <span class="px-3 py-1 bg-gray-50 text-gray-600 text-[11px] font-bold rounded-lg border border-gray-100">Remote</span>
                                                <span class="px-3 py-1 bg-purple-50 text-purple-600 text-[11px] font-bold rounded-lg border border-purple-100">Internship</span>
                                            </div>
                                        </div>
                                        <button class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-orange-50 hover:text-[#FF8C42] transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </button>
                                    </div>
                                    <div class="border-t border-gray-50 mt-4 pt-3 flex justify-between items-center text-xs text-[#9CA3AF]">
                                        <span>Posted 5 hours ago</span>
                                        <span class="font-bold text-[#2D3436]">IDR 4.000.000 - 6.000.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Activity Summary --}}
                    <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-bold text-[#2D3436]">Recent Activity</h2>
                            <a href="{{ route('applications.index') }}" class="text-sm font-bold text-[#636E72] hover:text-[#2D3436]">See All</a>
                        </div>
                        <div class="space-y-4">
                            {{-- Item 1 --}}
                            <div class="flex items-center justify-between pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center p-2">
                                        <img src="https://logo.clearbit.com/traveloka.com" class="w-full h-full object-contain">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-[#2D3436]">Product Manager</h4>
                                        <p class="text-xs text-[#636E72]">Traveloka • Applied 1d ago</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1.5 rounded-full text-[10px] font-bold bg-yellow-50 text-yellow-600 border border-yellow-100">Ditinjau</span>
                            </div>
                            {{-- Item 2 --}}
                            <div class="flex items-center justify-between pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center p-2">
                                        <img src="https://logo.clearbit.com/shopee.co.id" class="w-full h-full object-contain">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-[#2D3436]">Marketing Intern</h4>
                                        <p class="text-xs text-[#636E72]">Shopee • Applied 3d ago</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100">Wawancara</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT CONTENT (Sidebar) --}}
                <div class="lg:col-span-1 space-y-8">
                    
                    {{-- PROFILE COMPLETENESS WIDGET --}}
                    @php
                        // Logic Persentase (CV + Phone + Portfolio)
                        $progress = 0;
                        if(Auth::user()->cv_file_path) $progress += 40;
                        if(Auth::user()->phone_number) $progress += 30;
                        if(Auth::user()->portfolio_file_path) $progress += 30; // Tambahan Porto
                        
                        $isComplete = $progress == 100;
                    @endphp

                    <div class="bg-[#2D3436] rounded-[24px] p-6 text-white relative overflow-hidden shadow-xl">
                        {{-- Decorative Blob --}}
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF8C42] opacity-20 rounded-full blur-[40px] -mr-10 -mt-10"></div>
                        
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-bold text-lg">Profile Status</h3>
                                    <p class="text-gray-400 text-xs">Complete profile attracts 2x more recruiters.</p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center font-bold text-[#FF8C42] border border-white/5">
                                    {{ $progress }}%
                                </div>
                            </div>

                            {{-- Progress Bar --}}
                            <div class="w-full bg-gray-700 rounded-full h-2 mb-6">
                                <div class="bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] h-2 rounded-full transition-all duration-1000" style="width: {{ $progress }}%"></div>
                            </div>

                            <ul class="text-sm space-y-3 mb-6 text-gray-300">
                                {{-- Checklist 1: CV --}}
                                <li class="flex items-center gap-3 {{ Auth::user()->cv_file_path ? 'text-green-400 opacity-60 line-through' : '' }}">
                                    <div class="w-5 h-5 rounded-full border border-current flex items-center justify-center text-[10px] flex-shrink-0">
                                        @if(Auth::user()->cv_file_path) ✓ @else 1 @endif
                                    </div> 
                                    Upload CV
                                </li>
                                {{-- Checklist 2: Contact Info --}}
                                <li class="flex items-center gap-3 {{ Auth::user()->phone_number ? 'text-green-400 opacity-60 line-through' : '' }}">
                                    <div class="w-5 h-5 rounded-full border border-current flex items-center justify-center text-[10px] flex-shrink-0">
                                        @if(Auth::user()->phone_number) ✓ @else 2 @endif
                                    </div> 
                                    Fill Contact Info
                                </li>
                                {{-- Checklist 3: Portfolio (Requested) --}}
                                <li class="flex items-center gap-3 {{ Auth::user()->portfolio_file_path ? 'text-green-400 opacity-60 line-through' : '' }}">
                                    <div class="w-5 h-5 rounded-full border border-current flex items-center justify-center text-[10px] flex-shrink-0">
                                        @if(Auth::user()->portfolio_file_path) ✓ @else 3 @endif
                                    </div> 
                                    Upload Portfolio
                                </li>
                            </ul>

                            <a href="{{ route('user.account') }}" class="block w-full py-3 bg-white text-[#2D3436] text-center font-bold text-sm rounded-xl hover:bg-gray-100 transition shadow-md">
                                {{ $isComplete ? 'Edit Profile' : 'Complete Now' }}
                            </a>
                        </div>
                    </div>

                    {{-- News / Tips Widget --}}
                    <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-[#2D3436]">Career Tips</h3>
                            <span class="text-xs text-[#FF8C42] font-bold cursor-pointer">View All</span>
                        </div>
                        <div class="space-y-5">
                            <a href="#" class="block group">
                                <div class="h-32 w-full bg-gray-100 rounded-xl mb-3 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                                    <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <span class="absolute bottom-2 left-3 text-white text-[10px] font-bold z-20 bg-black/30 px-2 py-0.5 rounded backdrop-blur-sm">Interview</span>
                                </div>
                                <h4 class="text-sm font-bold text-[#2D3436] group-hover:text-[#FF8C42] transition leading-snug">How to ace your first interview like a pro</h4>
                                <p class="text-xs text-[#636E72] mt-1">5 min read • Career Guide</p>
                            </a>
                            <a href="#" class="block group">
                                <div class="h-32 w-full bg-gray-100 rounded-xl mb-3 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <span class="absolute bottom-2 left-3 text-white text-[10px] font-bold z-20 bg-black/30 px-2 py-0.5 rounded backdrop-blur-sm">Resume</span>
                                </div>
                                <h4 class="text-sm font-bold text-[#2D3436] group-hover:text-[#FF8C42] transition leading-snug">Building a killer portfolio for beginners</h4>
                                <p class="text-xs text-[#636E72] mt-1">3 min read • Resume Tips</p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection