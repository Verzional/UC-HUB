@extends('layouts.app')

@section('content')
    <div class="bg-[#F9FAFB] min-h-screen font-poppins pb-20">

        {{-- 1. HERO SEARCH SECTION --}}
        <div class="relative w-full overflow-hidden bg-[#1E1E1E] pt-20 pb-16 mb-0">
            <div class="absolute inset-0 bg-[linear-gradient(135deg,#FF8C42_0%,#FF3E8D_100%)] opacity-90"></div>
            <div class="absolute top-[-50%] left-[-20%] w-[800px] h-[800px] bg-white opacity-10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[400px] h-[400px] bg-[#FF8C42] opacity-30 rounded-full blur-[80px] pointer-events-none"></div>
            
            <div class="container mx-auto px-4 md:px-10 relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight drop-shadow-sm leading-tight">
                    Find Your Dream Job
                </h1>
                <p class="text-white/90 text-base md:text-lg max-w-2xl mx-auto font-light leading-relaxed mb-10">
                    Browse thousands of job openings from top companies and start your career today.
                </p>

                {{-- SEARCH FORM --}}
                <form id="searchForm" action="{{ route('jobs.index') }}" method="GET" class="relative max-w-7xl mx-auto">
                    <div class="bg-white p-1.5 rounded-full shadow-[0_10px_40px_rgba(0,0,0,0.15)] flex flex-col md:flex-row items-center border border-white/20 backdrop-blur-xl">

                        {{-- INPUT SEARCH --}}
                        <div class="flex items-center w-full md:w-[45%] px-5 py-2.5 relative border-b md:border-b-0 md:border-r border-gray-100">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <div class="relative w-full">
                                <input type="text" id="inputSearch" name="search" value="{{ request('search') }}"
                                    placeholder="Search by job title, keywords..."
                                    class="filter-input w-full py-1 pr-8 outline-none text-[#2D3436] font-medium placeholder-gray-400 bg-transparent text-sm md:text-base">
                                <button type="button" id="clearSearchBtn" class="hidden absolute right-0 top-1/2 -translate-y-1/2 text-gray-300 hover:text-[#FF8C42] p-1 rounded-full hover:bg-orange-50 transition">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                </button>
                            </div>
                        </div>

                        {{-- INPUT LOCATION --}}
                        <div class="flex items-center w-full md:w-[40%] px-5 py-2.5 relative">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div class="relative w-full">
                                <input type="text" id="inputLocation" name="location" value="{{ request('location') }}"
                                    placeholder="City, province, or region..."
                                    class="filter-input w-full py-1 pr-8 outline-none text-[#2D3436] font-medium placeholder-gray-400 bg-transparent text-sm md:text-base">
                                <button type="button" id="clearLocationBtn" class="hidden absolute right-0 top-1/2 -translate-y-1/2 text-gray-300 hover:text-[#FF8C42] p-1 rounded-full hover:bg-orange-50 transition">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                </button>
                            </div>
                        </div>

                        {{-- BUTTON SEARCH --}}
                        <div class="w-full md:w-[15%] p-1">
                            <button type="submit" class="w-full h-full bg-[#2D3436] hover:bg-black text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- 2. MAIN CONTENT --}}
        <div class="container mx-auto px-4 md:px-10 flex flex-col lg:flex-row gap-8 mt-8">

            {{-- SIDEBAR FILTER --}}
            <aside class="w-full lg:w-[280px] flex-shrink-0">
                <form id="filterForm">
                    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-gray-100 sticky top-28">

                        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                            <h3 class="font-bold text-lg text-[#2D3436]">Filters</h3>
                            <button type="button" id="resetBtn" class="text-xs text-[#FF8C42] font-bold hover:text-[#FF3E8D] transition bg-orange-50 hover:bg-orange-100 px-3 py-1.5 rounded-full">
                                Reset
                            </button>
                        </div>

                        {{-- 1. CATEGORY --}}
                        <div class="mb-6">
                            <h4 class="font-bold text-xs text-[#2D3436] uppercase tracking-wider mb-4">Category</h4>
                            <div class="space-y-3 max-h-[220px] overflow-y-auto pr-2 custom-scrollbar">
                                @foreach ($categories as $cat)
                                    <label class="flex items-center gap-3 cursor-pointer group select-none hover:bg-gray-50 p-1.5 rounded-lg transition -mx-1.5">
                                        <div class="relative flex items-center">
                                            <input type="checkbox" name="categories[]" value="{{ $cat->name }}" class="filter-input peer appearance-none w-4 h-4 border-2 border-gray-300 rounded checked:bg-[#FF8C42] checked:border-[#FF8C42] transition-colors cursor-pointer">
                                            <svg class="absolute w-2.5 h-2.5 text-white hidden peer-checked:block left-0.5 top-0.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span class="text-sm text-[#636E72] font-medium group-hover:text-[#2D3436] transition">{{ $cat->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- 2. JOB TYPE --}}
                        <div class="mb-6">
                            <h4 class="font-bold text-xs text-[#2D3436] uppercase tracking-wider mb-4">Job Type</h4>
                            @php $types = ['Full Time', 'Part Time', 'Intern', 'Freelance']; @endphp
                            <div class="space-y-2">
                                @foreach ($types as $type)
                                    <label class="flex items-center gap-3 cursor-pointer group select-none hover:bg-gray-50 p-1.5 rounded-lg transition -mx-1.5">
                                        <div class="relative flex items-center">
                                            <input type="checkbox" name="types[]" value="{{ $type }}" class="filter-input peer appearance-none w-4 h-4 border-2 border-gray-300 rounded checked:bg-[#FF8C42] checked:border-[#FF8C42] transition-colors cursor-pointer">
                                            <svg class="absolute w-2.5 h-2.5 text-white hidden peer-checked:block left-0.5 top-0.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span class="text-sm text-[#636E72] font-medium group-hover:text-[#2D3436] transition">{{ $type }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- 3. SALARY SLIDER --}}
                        <div class="mb-8">
                            <h4 class="font-bold text-xs text-[#2D3436] uppercase tracking-wider mb-5">Salary Range</h4>
                            <div class="px-2 mb-4">
                                <div id="salarySlider"></div>
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-bold text-[#636E72] bg-gray-50 p-2 rounded-lg border border-gray-100">
                                <span id="salaryMinLabel">Rp 0</span>
                                <span class="text-gray-300">-</span>
                                <span id="salaryMaxLabel">Rp {{ number_format($globalMaxSalary, 0, ',', '.') }}</span>
                            </div>
                            <input type="hidden" name="min_salary" id="inputMinSalary">
                            <input type="hidden" name="max_salary" id="inputMaxSalary">
                        </div>

                        {{-- 4. WORK MODEL --}}
                        <div>
                            <h4 class="font-bold text-xs text-[#2D3436] uppercase tracking-wider mb-4">Work Model</h4>
                            @php $models = ['Onsite', 'Remote', 'Hybrid']; @endphp
                            <div class="space-y-2">
                                @foreach ($models as $model)
                                    <label class="flex items-center gap-3 cursor-pointer group select-none hover:bg-gray-50 p-1.5 rounded-lg transition -mx-1.5">
                                        <div class="relative flex items-center">
                                            <input type="radio" name="work_model" value="{{ $model }}" class="filter-input peer appearance-none w-4 h-4 border-2 border-gray-300 rounded-full checked:border-[#FF8C42] checked:border-4 transition-all cursor-pointer">
                                        </div>
                                        <span class="text-sm text-[#636E72] font-medium group-hover:text-[#2D3436] transition">{{ $model }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </aside>

            {{-- JOB LIST CONTAINER --}}
            <div class="flex-1 min-w-0" id="job-list-container">
                @include('jobs.partials.job-list')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('job-list-container');
            const searchForm = document.getElementById('searchForm');
            const filterForm = document.getElementById('filterForm');
            const resetBtn = document.getElementById('resetBtn');
            const sliderElement = document.getElementById('salarySlider');

            // Search & Clear Button
            const inputSearch = document.getElementById('inputSearch');
            const clearSearchBtn = document.getElementById('clearSearchBtn');
            const inputLocation = document.getElementById('inputLocation');
            const clearLocationBtn = document.getElementById('clearLocationBtn');

            // --- 1. SETUP SLIDER ---
            const maxSalary = {{ $globalMaxSalary }};

            if (sliderElement && typeof noUiSlider !== 'undefined') {
                noUiSlider.create(sliderElement, {
                    start: [0, maxSalary],
                    connect: true,
                    range: { 'min': 0, 'max': maxSalary },
                    step: 500000,
                    tooltips: false,
                    format: {
                        to: function(value) { return Math.round(value); },
                        from: function(value) { return value; }
                    }
                });

                sliderElement.noUiSlider.on('update', function(values) {
                    document.getElementById('salaryMinLabel').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(values[0]);
                    document.getElementById('salaryMaxLabel').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(values[1]);
                    document.getElementById('inputMinSalary').value = values[0];
                    document.getElementById('inputMaxSalary').value = values[1];
                });

                sliderElement.noUiSlider.on('change', function() { fetchJobs(); });
            }

            // --- 2. FETCH JOBS (AJAX UTAMA) ---
            function fetchJobs(targetUrl = null) {
                let fetchUrl;

                if (targetUrl) {
                    // KASUS 1: Klik Pagination (Gunakan URL asli dari Laravel)
                    fetchUrl = targetUrl;
                } else {
                    // KASUS 2: Ganti Filter / Search / Reset (Buat URL sendiri)
                    const searchData = new FormData(searchForm);
                    const filterData = new FormData(filterForm);
                    const params = new URLSearchParams();

                    for (const pair of searchData.entries()) { if (pair[1]) params.append(pair[0], pair[1]); }
                    for (const pair of filterData.entries()) { if (pair[1]) params.append(pair[0], pair[1]); }

                    fetchUrl = "{{ route('jobs.index') }}?" + params.toString();
                }

                // Efek Loading UI
                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';

                fetch(fetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(response => response.text())
                .then(html => {
                    container.innerHTML = html;
                    container.style.opacity = '1';
                    container.style.pointerEvents = 'auto';
                    
                    // Update URL Browser agar sinkron
                    window.history.pushState(null, '', fetchUrl);
                })
                .catch(error => { 
                    console.error('Error:', error); 
                    container.style.opacity = '1'; 
                    container.style.pointerEvents = 'auto'; 
                });
            }

            // --- 3. EVENT LISTENERS ---
            filterForm.addEventListener('change', function(e) {
                if (e.target.classList.contains('filter-input')) fetchJobs();
            });

            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                fetchJobs();
            });

            // Logic Clear Button
            function toggleClearBtn(input, btn) {
                if (input.value.trim().length > 0) btn.classList.remove('hidden');
                else btn.classList.add('hidden');
            }

            toggleClearBtn(inputSearch, clearSearchBtn);
            toggleClearBtn(inputLocation, clearLocationBtn);

            inputSearch.addEventListener('input', () => toggleClearBtn(inputSearch, clearSearchBtn));
            inputLocation.addEventListener('input', () => toggleClearBtn(inputLocation, clearLocationBtn));

            clearSearchBtn.addEventListener('click', function() {
                inputSearch.value = '';
                toggleClearBtn(inputSearch, clearSearchBtn);
                fetchJobs();
            });

            clearLocationBtn.addEventListener('click', function() {
                inputLocation.value = '';
                toggleClearBtn(inputLocation, clearLocationBtn);
                fetchJobs();
            });

            resetBtn.addEventListener('click', function() {
                filterForm.reset();
                searchForm.reset();
                inputSearch.value = '';
                inputLocation.value = '';
                toggleClearBtn(inputSearch, clearSearchBtn);
                toggleClearBtn(inputLocation, clearLocationBtn);
                
                if (sliderElement && sliderElement.noUiSlider) {
                    sliderElement.noUiSlider.set([0, maxSalary]);
                }
                fetchJobs();
            });

            // --- 4. PAGINATION CLICK HANDLER (PERBAIKAN) ---
            container.addEventListener('click', function(e) {
                // Cari elemen 'a' terdekat (link)
                const link = e.target.closest('a');

                // Cek apakah yang diklik adalah link pagination
                if (link && link.closest('.pagination-wrapper')) {
                    e.preventDefault(); // Cegah refresh halaman
                    
                    if (link.href) {
                        fetchJobs(link.href); // Panggil AJAX dengan URL dari tombol
                        document.getElementById('job-list-container').scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });
    </script>
@endpush

<style>
    /* CSS FIX UNTUK PAGINATION AGAR ICON TIDAK MENGHALANGI KLIK */
    .pagination-wrapper svg, 
    .pagination-wrapper path { 
        pointer-events: none; 
    }

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #FF8C42; }

    /* Custom Slider */
    .noUi-connect { background: #FF8C42 !important; }
    .noUi-handle { border-radius: 50% !important; border: 3px solid #FF8C42 !important; background: white !important; box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important; cursor: pointer !important; width: 16px !important; height: 16px !important; right: -8px !important; top: -6px !important; }
    .noUi-horizontal { height: 4px !important; border: none !important; background: #E2E8F0 !important; border-radius: 10px !important; }
    .noUi-handle::before, .noUi-handle::after { display: none !important; }
</style>