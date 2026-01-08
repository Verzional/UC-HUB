@extends('layouts.app')

@section('content')
    <div class="relative bg-[#F9FAFB] min-h-screen font-poppins">

        {{-- 1. HEADER SECTION --}}
        <div class="relative h-[350px] w-full overflow-hidden bg-[#1E1E1E]">
            <div class="absolute inset-0 bg-[linear-gradient(135deg,#FF8C42_0%,#FF3E8D_100%)] opacity-90"></div>
            <div class="absolute top-[-50%] left-[-20%] w-[800px] h-[800px] bg-white opacity-10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[400px] h-[400px] bg-[#FF8C42] opacity-30 rounded-full blur-[80px] pointer-events-none"></div>

            <div class="container mx-auto px-4 md:px-20 pt-10 relative z-10 text-center">
                {{-- Breadcrumb --}}
                <div class="flex justify-center mb-6">
                    {{-- <a href="{{ route('home') }}"
                        class="inline-flex items-center text-white/80 hover:text-white bg-white/10 hover:bg-white/20 backdrop-blur-md px-5 py-2 rounded-full transition-all text-sm font-medium group border border-white/10">
                        <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Dashboard
                    </a> --}}
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight drop-shadow-sm">My Applications</h1>
                <p class="text-white/90 text-lg max-w-2xl mx-auto font-light leading-relaxed">
                    Track the progress of your job applications. Keep your career moving forward.
                </p>
            </div>
        </div>

        {{-- 2. SEARCH & FILTER SECTION --}}
        <div class="container mx-auto px-4 md:px-20 relative -mt-20 z-20">
            <div class="bg-white rounded-[20px] p-4 shadow-[0_15px_40px_rgba(0,0,0,0.08)] border border-gray-100">
                
                {{-- Form Wrapper --}}
                <form id="filterForm" class="flex flex-col md:flex-row gap-4 items-center p-2">
                    
                    {{-- 1. STATUS FILTER --}}
                    <div class="relative w-full md:w-[280px]">
                        <div class="cursor-pointer group" onclick="toggleStatusDropdown()">
                            <div class="flex justify-between items-center bg-gray-50 hover:bg-gray-100 rounded-[50px] px-6 py-3.5 transition-colors border border-transparent hover:border-gray-200">
                                <div class="flex flex-col items-start">
                                    <span class="text-[10px] text-[#636E72] font-bold uppercase tracking-wider leading-tight">Filter By</span>
                                    <span class="font-bold text-[#2D3436] text-sm leading-tight">Status Application</span>
                                </div>
                                <svg id="arrowIcon" class="w-5 h-5 text-gray-400 group-hover:text-[#FF8C42] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- Checkboxes Dropdown --}}
                        <div id="statusList" class="hidden absolute top-full left-0 w-full bg-white border border-gray-100 shadow-xl rounded-2xl mt-2 p-4 z-30 space-y-3 animate-fade-in-up">
                            @php $statuses = ['Ditinjau', 'Wawancara', 'Diterima', 'Ditolak']; @endphp
                            @foreach ($statuses as $status)
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="status[]" value="{{ $status }}"
                                            class="filter-checkbox peer appearance-none w-5 h-5 border-2 border-gray-300 rounded checked:bg-[#FF8C42] checked:border-[#FF8C42] transition-colors cursor-pointer"
                                            {{ in_array($status, request('status', [])) ? 'checked' : '' }}>
                                        <svg class="absolute w-3 h-3 text-white hidden peer-checked:block left-1 top-1 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span class="text-sm font-medium text-[#636E72] group-hover:text-[#FF8C42] transition">{{ $status }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- 2. SEARCH BAR --}}
                    <div class="flex-1 w-full">
                        <div class="relative w-full flex items-center bg-white border border-gray-200 rounded-[50px] shadow-sm hover:shadow-md transition-shadow duration-300 focus-within:ring-2 focus-within:ring-[#FF8C42]/20 focus-within:border-[#FF8C42]">
                            
                            <div class="pl-6 pr-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            
                            <input type="text" id="inputSearch" name="search" value="{{ request('search') }}"
                                placeholder="Search by job title or company..."
                                class="w-full py-3.5 pr-10 bg-transparent border-none outline-none text-[#2D3436] placeholder-gray-400 text-sm font-medium focus:ring-0">
                            
                            {{-- Clear Button --}}
                            <button type="button" id="clearSearchBtn"
                                class="hidden absolute right-3 p-1.5 text-gray-300 hover:text-[#FF8C42] hover:bg-orange-50 rounded-full transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Search Button --}}
                    <div class="w-full md:w-auto">
                        <button type="submit"
                            class="w-full md:w-auto bg-[#2D3436] hover:bg-black text-white font-bold py-3.5 px-10 rounded-[50px] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition duration-200 text-sm">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- 3. CONTAINER LIST APLIKASI --}}
        <div class="container mx-auto px-4 md:px-20 py-12" id="application-list-container">
            @auth
                @include('applications.partials.application-list')
            @endauth

            {{-- TAMPILAN BACKGROUND JIKA GUEST (Tertutup Modal Nanti) --}}
            @guest
                <div class="bg-white p-12 rounded-[24px] flex flex-col items-center justify-center text-center shadow-[0_5px_20px_rgba(0,0,0,0.03)] border border-gray-100 opacity-50 pointer-events-none">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-400 mb-2">Please Login</h3>
                    <p class="text-gray-400">Login to see your application history.</p>
                </div>
            @endguest
        </div>

    </div>

    {{-- ================================================================= --}}
    {{-- MODALS SECTION --}}
    {{-- ================================================================= --}}

    {{-- AUTH MODAL (LOGIN REQUIRED) --}}
    <div id="authModal" class="fixed inset-0 z-[3000] hidden flex items-center justify-center">
        {{-- Backdrop Blur --}}
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeAuthModal()"></div>
        
        {{-- Modal Content --}}
        <div class="bg-white rounded-[24px] w-full max-w-sm p-8 relative text-center transform transition-all scale-100 z-10 shadow-2xl animate-fade-in-up">
            <button onclick="closeAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-[#FF8C42] transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-5 text-[#FF8C42]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-[#2D3436] mb-2">Login Required</h3>
            <p class="text-[#636E72] mb-8 text-sm">Please login to view your application history.</p>
            <div class="space-y-3">
                <a href="{{ route('login') }}" class="block w-full py-3 rounded-full bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold shadow-md hover:shadow-lg transition hover:-translate-y-0.5">Login</a>
                <a href="{{ route('register') }}" class="block w-full py-3 rounded-full border border-[#FF8C42] text-[#FF8C42] font-bold hover:bg-orange-50 transition">Create Account</a>
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <div id="appDetailModal" class="fixed inset-0 z-[2000] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeDetailModal()"></div>
        <div class="bg-white rounded-[24px] w-full max-w-3xl max-h-[90vh] overflow-y-auto relative p-8 shadow-2xl animate-fade-in-up">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 id="modalJobTitle" class="text-2xl font-bold text-[#2D3436]">Loading...</h2>
                    <p id="modalCompanyName" class="text-[#636E72] font-medium text-sm mt-1">Loading...</p>
                    <div id="modalStatusBadge" class="mt-3 inline-block px-5 py-2 rounded-full text-white text-xs font-bold bg-gray-400 shadow-md">Loading...</div>
                </div>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-[#FF8C42] bg-gray-50 hover:bg-orange-50 p-2 rounded-full transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <div class="flex flex-col lg:flex-row gap-10">
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-[#2D3436] mb-5 border-b border-gray-100 pb-2">Timeline</h3>
                    <div id="timelineContainer" class="space-y-0 relative pl-2"></div>
                </div>
                <div class="w-full lg:w-[40%]">
                    <h3 class="text-lg font-bold text-[#2D3436] mb-5 border-b border-gray-100 pb-2">Documents</h3>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 mb-4">
                        <div class="flex items-center justify-between mb-2"><span class="text-xs font-bold text-[#636E72] uppercase">CV / Resume</span><button id="btnViewCv" class="text-[10px] bg-white border border-gray-200 px-3 py-1 rounded-full text-[#2D3436] font-bold hover:text-[#FF8C42] hover:border-orange-200 transition">View</button></div>
                        <div class="flex items-center gap-2"><svg class="w-4 h-4 text-[#FF3E8D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg><span id="modalCvName" class="text-xs text-[#2D3436] font-medium truncate w-32">file.pdf</span></div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hidden" id="modalPortoSection">
                        <div class="flex items-center justify-between mb-2"><span class="text-xs font-bold text-[#636E72] uppercase">Portfolio</span><button id="btnViewPorto" class="text-[10px] bg-white border border-gray-200 px-3 py-1 rounded-full text-[#2D3436] font-bold hover:text-[#FF8C42] hover:border-orange-200 transition">View</button></div>
                        <div class="flex items-center gap-2"><svg class="w-4 h-4 text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg><span id="modalPortoName" class="text-xs text-[#2D3436] font-medium truncate w-32">file.pdf</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PDF Modal --}}
    <div id="pdfModal" class="fixed inset-0 z-[2500] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closePdfModal()"></div>
        <div class="bg-white rounded-[24px] w-full max-w-4xl h-[85vh] relative flex flex-col shadow-2xl overflow-hidden z-10">
            <div class="flex justify-between items-center p-4 border-b border-gray-100 bg-white">
                <h3 class="font-bold text-lg text-[#2D3436]">Document Preview</h3>
                <button onclick="closePdfModal()" class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <div class="flex-1 bg-gray-100 p-0 overflow-hidden relative"><iframe id="pdfViewerFrame" src="" class="w-full h-full border-0"></iframe></div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('application-list-container');
        const filterForm = document.getElementById('filterForm');
        const inputSearch = document.getElementById('inputSearch');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        const authModal = document.getElementById('authModal');

        // --- 1. AUTH MODAL LOGIC (OTOMATIS MUNCUL) ---
        @guest
            authModal.classList.remove('hidden');
        @endguest

        window.closeAuthModal = function() {
            // Redirect ke home jika ditutup agar tidak stuck di halaman ini tanpa login
            window.location.href = "{{ route('home') }}";
        }

        // --- 2. AJAX FETCH FUNCTION ---
        window.fetchApplications = function(url = "{{ route('applications.index') }}") {
            const formData = new FormData(filterForm);
            const params = new URLSearchParams();
            for (const pair of formData.entries()) { if (pair[1]) params.append(pair[0], pair[1]); }
            const fetchUrl = url.includes('page=') ? url + '&' + params.toString() : url + '?' + params.toString();

            container.style.opacity = '0.5';
            container.style.pointerEvents = 'none';

            fetch(fetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
                container.style.opacity = '1';
                container.style.pointerEvents = 'auto';
                window.history.pushState(null, '', fetchUrl);
            })
            .catch(error => { console.error('Error:', error); container.style.opacity = '1'; container.style.pointerEvents = 'auto'; });
        }

        // --- 3. SEARCH & FILTER EVENTS ---
        function checkInput() {
            if (inputSearch.value.trim().length > 0) clearSearchBtn.classList.remove('hidden');
            else clearSearchBtn.classList.add('hidden');
        }
        checkInput();

        inputSearch.addEventListener('input', () => checkInput());
        
        clearSearchBtn.addEventListener('click', function() {
            inputSearch.value = '';
            checkInput();
            fetchApplications();
            inputSearch.focus();
        });

        checkboxes.forEach(box => { box.addEventListener('change', () => fetchApplications()); });
        
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetchApplications();
        });

        container.addEventListener('click', function(e) {
            const link = e.target.closest('.pagination-wrapper a');
            if (link && link.href) {
                e.preventDefault();
                fetchApplications(link.href);
                document.querySelector('.container').scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    function toggleStatusDropdown() {
        const list = document.getElementById('statusList');
        const icon = document.getElementById('arrowIcon');
        if (list.classList.contains('hidden')) {
            list.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            list.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    // Modal Detail & PDF Logic (Sama)
    function openDetailModal(app) {
        document.getElementById('appDetailModal').classList.remove('hidden');
        document.getElementById('modalJobTitle').innerText = app.job ? app.job.title : 'Job Unavailable';
        document.getElementById('modalCompanyName').innerText = app.company ? app.company.name : 'Unknown Company';

        const badge = document.getElementById('modalStatusBadge');
        badge.innerText = app.status;
        badge.className = "mt-3 inline-block px-5 py-2 rounded-full text-white text-xs font-bold shadow-md";
        if (app.status === 'Diterima') badge.classList.add('bg-[#4CD964]', 'shadow-[#4CD964]/30');
        else if (app.status === 'Wawancara') badge.classList.add('bg-[#5856D6]', 'shadow-[#5856D6]/30');
        else if (app.status === 'Ditolak') badge.classList.add('bg-[#FF3B30]', 'shadow-[#FF3B30]/30');
        else { badge.classList.remove('text-white', 'shadow-md'); badge.classList.add('bg-[#FFFF00]/20', 'text-[#D4A017]', 'ring-1', 'ring-[#D4A017]/50'); }

        const timelineContainer = document.getElementById('timelineContainer');
        timelineContainer.innerHTML = '';
        const timeline = app.timeline || [];
        timeline.forEach((event, index) => {
            const isLast = index === timeline.length - 1;
            let colorClass = event.isCompleted ? 'bg-[#4CD964]' : (event.isActive ? 'bg-[#FF8C42]' : 'bg-gray-300');
            let iconHtml = event.isCompleted ? `<svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>` : (event.isActive ? `<div class="w-2 h-2 bg-white rounded-full"></div>` : '');
            
            if (event.isActive) {
                if(app.status === 'Wawancara') colorClass = 'bg-[#5856D6]';
                if(app.status === 'Ditolak') colorClass = 'bg-[#FF3B30]';
            }

            const itemHtml = `
            <div class="flex gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full ${colorClass} flex items-center justify-center shadow-sm z-10">${iconHtml}</div>
                    ${!isLast ? '<div class="w-0.5 h-full bg-gray-200 -my-1"></div>' : ''}
                </div>
                <div class="pb-8">
                    <p class="text-xs text-[#B2B2B2] mb-1 font-semibold">${event.date}</p>
                    <h4 class="text-sm font-bold text-[#2D3436]">${event.title}</h4>
                </div>
            </div>`;
            timelineContainer.innerHTML += itemHtml;
        });

        document.getElementById('modalCvName').innerText = app.cv_file_name;
        document.getElementById('btnViewCv').onclick = () => viewPdf(`{{ asset('storage/documents') }}/${app.cv_file_name}`);
        const portoSec = document.getElementById('modalPortoSection');
        if(app.portfolio_file_name) {
            portoSec.classList.remove('hidden');
            document.getElementById('modalPortoName').innerText = app.portfolio_file_name;
            document.getElementById('btnViewPorto').onclick = () => viewPdf(`{{ asset('storage/documents') }}/${app.portfolio_file_name}`);
        } else { portoSec.classList.add('hidden'); }
    }

    function closeDetailModal() { document.getElementById('appDetailModal').classList.add('hidden'); }
    function viewPdf(url) { document.getElementById('pdfModal').classList.remove('hidden'); document.getElementById('pdfViewerFrame').src = url; }
    function closePdfModal() { document.getElementById('pdfModal').classList.add('hidden'); document.getElementById('pdfViewerFrame').src = ""; }
</script>
@endpush