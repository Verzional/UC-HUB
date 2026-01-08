@extends('layouts.app')

@section('content')
    <div class="relative bg-[#F9FAFB] min-h-screen font-poppins">

        {{-- 1. HEADER SECTION --}}
        <div class="relative h-[350px] w-full overflow-hidden bg-[#1E1E1E]">
            {{-- Gradient Background --}}
            <div class="absolute inset-0 bg-[linear-gradient(135deg,#FF8C42_0%,#FF3E8D_100%)] opacity-90"></div>
            <div class="absolute top-[-50%] left-[-20%] w-[800px] h-[800px] bg-white opacity-10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[400px] h-[400px] bg-[#FF8C42] opacity-30 rounded-full blur-[80px] pointer-events-none"></div>

            <div class="container mx-auto px-4 md:px-20 pt-10 relative z-10">
                {{-- BACK BUTTON (KIRI ATAS) --}}
                <div class="flex justify-start mb-8">
                    {{-- <a href="{{ route('jobs.index') }}"
                        class="inline-flex items-center text-white/90 hover:text-white bg-white/10 hover:bg-white/20 backdrop-blur-md px-5 py-2.5 rounded-full transition-all text-sm font-bold group border border-white/20 shadow-sm">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Back to Jobs
                    </a> --}}
                </div>

                {{-- Title Center --}}
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight drop-shadow-sm">Your Saved Opportunities</h1>
                    <p class="text-white/90 text-lg max-w-2xl mx-auto font-light leading-relaxed">
                        Review and manage the jobs you've bookmarked. Don't let your dream career slip away!
                    </p>
                </div>
            </div>
        </div>

        {{-- 2. SEARCH & FILTER (AJAX TRIGGER) --}}
        <div class="container mx-auto px-4 md:px-20 relative -mt-20 z-20">
            <div class="bg-white rounded-[20px] p-4 md:p-6 shadow-[0_15px_40px_rgba(0,0,0,0.08)] border border-gray-100">
                <form id="filterForm" class="flex flex-col md:flex-row gap-4 items-center">
                    
                    {{-- Search Input --}}
                    <div class="relative w-full flex-1">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        
                        <input type="text" name="q" id="inputSearch" value="{{ request('q') }}" 
                            class="w-full pl-11 pr-10 py-3.5 bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-[#FF8C42] focus:border-[#FF8C42] transition-colors outline-none placeholder-gray-400" 
                            placeholder="Search saved jobs by title or company...">

                        {{-- Tombol X (Clear) --}}
                        <button type="button" id="clearSearchBtn" 
                            class="hidden absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-[#FF8C42] transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>

                    {{-- Sort (AJAX Trigger) --}}
                    <div class="w-full md:w-auto relative">
                        <select name="sort" id="sortSelect" onchange="fetchJobs()"
                            class="w-full md:w-48 pl-4 pr-10 py-3.5 bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-[#FF8C42] focus:border-[#FF8C42] appearance-none cursor-pointer outline-none hover:bg-gray-100 transition">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Added</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest Added</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- 3. CONTENT LIST (CONTAINER AJAX) --}}
        <div class="container mx-auto px-4 md:px-20 py-12 min-h-[500px]" id="saved-jobs-container">
            @auth
                {{-- Include Partial View --}}
                @include('jobs.partials.saved-jobs-list')
            @endauth

            @guest
                <div class="bg-white rounded-[30px] p-12 flex flex-col items-center justify-center text-center shadow-[0_10px_40px_rgba(0,0,0,0.03)] min-h-[400px] border border-gray-100">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-400">Please Login to View Saved Jobs</h2>
                </div>
            @endguest
        </div>
    </div>

    {{-- AUTH MODAL --}}
    <div id="authModal" class="fixed inset-0 z-[2000] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeAuthModal()"></div>
        <div class="bg-white rounded-[24px] w-full max-w-sm p-8 relative text-center transform transition-all scale-100 z-10 shadow-2xl">
            <button onclick="closeAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-[#FF8C42] transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-5 text-[#FF8C42]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg></div>
            <h3 class="text-2xl font-bold text-[#2D3436] mb-2">Login Required</h3>
            <p class="text-[#636E72] mb-8 text-sm">Please login to view your saved jobs.</p>
            <div class="space-y-3">
                <a href="{{ route('login') }}" class="block w-full py-3 rounded-full bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold shadow-md hover:shadow-lg transition">Login</a>
                <a href="{{ route('register') }}" class="block w-full py-3 rounded-full border border-[#FF8C42] text-[#FF8C42] font-bold hover:bg-orange-50 transition">Create Account</a>
            </div>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div id="deleteModal" class="fixed inset-0 z-[1000] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-[3px] transition-opacity" onclick="closeDeleteModal()"></div>
        <div class="bg-white rounded-[24px] w-full max-w-[320px] p-0 relative transform scale-100 shadow-2xl overflow-hidden z-10 animate-fade-in-up">
            <div class="p-8 pb-4 text-center">
                <div class="mx-auto w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-[#FF3B30]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <h3 class="text-[20px] font-bold text-[#2D3436] mb-2">Remove Favorite?</h3>
                <p class="text-[#636E72] text-[14px] leading-relaxed">
                    Are you sure you want to remove <span id="jobTitleToDelete" class="font-bold text-[#2D3436]">Title</span>?
                </p>
            </div>
            <div class="flex p-6 pt-2 gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 py-3 rounded-[15px] border border-[#B2B2B2] text-[#636E72] font-bold text-[14px] hover:bg-gray-50 transition">Cancel</button>
                <form id="deleteForm" action="" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-3 rounded-[15px] bg-[#FF3B30] text-white font-bold text-[14px] shadow-[0_4px_10px_rgba(255,59,48,0.3)] hover:bg-red-600 transition">Remove</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const container = document.getElementById('saved-jobs-container');
    const inputSearch = document.getElementById('inputSearch');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const sortSelect = document.getElementById('sortSelect');
    const filterForm = document.getElementById('filterForm');

    // --- 1. AJAX FETCH FUNCTION ---
    let debounceTimer;
    
    // Trigger saat ngetik (dengan delay 500ms biar gak spam request)
    inputSearch.addEventListener('input', function() {
        toggleClearBtn();
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchJobs();
        }, 500);
    });

    // Mencegah submit form saat tekan Enter
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetchJobs();
    });

    // Fungsi Fetch ke Backend
    function fetchJobs() {
        const query = inputSearch.value;
        const sort = sortSelect.value;
        
        // Efek Loading: Transparan dikit
        container.style.opacity = '0.5';
        
        fetch(`{{ route('jobs.saved') }}?q=${query}&sort=${sort}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
            container.style.opacity = '1';
        })
        .catch(error => {
            console.error('Error:', error);
            container.style.opacity = '1';
        });
    }

    // --- 2. SEARCH UI LOGIC ---
    function toggleClearBtn() {
        if(inputSearch.value.length > 0) clearSearchBtn.classList.remove('hidden');
        else clearSearchBtn.classList.add('hidden');
    }

    clearSearchBtn.addEventListener('click', function() {
        inputSearch.value = '';
        toggleClearBtn();
        fetchJobs(); // Refresh balik ke awal
        inputSearch.focus();
    });

    // Init check (kalau user refresh browser saat ada text)
    toggleClearBtn();


    // --- 3. MODAL LOGIC (AUTH & DELETE) ---
    const authModal = document.getElementById('authModal');
    const deleteModal = document.getElementById('deleteModal');
    const jobTitleSpan = document.getElementById('jobTitleToDelete');
    const deleteForm = document.getElementById('deleteForm');

    document.addEventListener('DOMContentLoaded', function() {
        @guest authModal.classList.remove('hidden'); @endguest
    });

    function closeAuthModal() { window.history.back(); }

    function openDeleteModal(jobId, jobTitle) {
        event.preventDefault(); // Stop link redirect
        deleteForm.action = `/jobs/${jobId}/favorite`;
        jobTitleSpan.innerText = `"${jobTitle}"`;
        deleteModal.classList.remove('hidden');
    }
    
    function closeDeleteModal() { deleteModal.classList.add('hidden'); }
</script>
@endpush