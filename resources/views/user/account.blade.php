@extends('layouts.app')

@section('content')
    <div class="bg-[#F9FAFB] min-h-screen font-poppins relative pb-20">

        {{-- 1. HEADER BANNER (Abstract Background) --}}
        <div class="h-[250px] w-full bg-[#1E1E1E] relative overflow-hidden">
            <div class="absolute inset-0 bg-[linear-gradient(135deg,#FF8C42_0%,#FF3E8D_100%)] opacity-90"></div>
            <div
                class="absolute top-[-50%] left-[-20%] w-[600px] h-[600px] bg-white opacity-10 rounded-full blur-[100px] pointer-events-none">
            </div>
            <div class="container mx-auto px-4 md:px-20 relative z-10 h-full flex items-center">
                <div class="text-white">
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">My Account</h1>
                    <p class="text-white/80 text-sm md:text-base">Manage your profile information and account security.</p>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 md:px-20 relative -mt-16 z-20">

            {{-- ALERT ERROR (Modern Style) --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm mb-8 animate-fade-in-up">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- FORM START --}}
            <form id="profileForm" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    {{-- LEFT COLUMN: PROFILE CARD --}}
                    <div class="lg:col-span-4">
                        <div
                            class="bg-white rounded-[24px] shadow-[0_5px_30px_rgba(0,0,0,0.05)] border border-gray-100 p-8 text-center sticky top-24">

                            {{-- Foto Profil --}}
                            <div class="relative inline-block group mb-6">
                                <div class="w-32 h-32 rounded-full p-1 bg-white shadow-lg border border-gray-100 mx-auto">
                                    <img id="photoPreview"
                                        src="{{ $user->photo_url ? asset('storage/' . $user->photo_url) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                                        class="w-full h-full rounded-full object-cover">
                                </div>

                                {{-- Tombol Upload Foto (Camera Icon) --}}
                                <label for="photo_upload"
                                    class="absolute bottom-1 right-1 bg-[#2D3436] text-white w-10 h-10 rounded-full flex items-center justify-center cursor-pointer hover:bg-[#FF8C42] hover:scale-110 transition shadow-md border-4 border-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <input type="file" id="photo_upload" name="photo" class="hidden" accept="image/*"
                                        onchange="previewImage(event)">
                                </label>
                            </div>

                            <h2 class="text-xl font-bold text-[#2D3436]">{{ $user->name }}</h2>
                            <p class="text-sm text-[#636E72] mb-6">{{ $user->email }}</p>

                            <div class="border-t border-gray-100 pt-6">
                                <button type="button" onclick="openPasswordModal()"
                                    class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-gray-50 text-[#2D3436] font-bold text-sm hover:bg-[#2D3436] hover:text-white transition-all duration-300 group">
                                    <svg class="w-4 h-4 text-[#636E72] group-hover:text-white transition" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT COLUMN: EDIT FORM --}}
                    <div class="lg:col-span-8 space-y-8">

                        {{-- CARD 1: GENERAL INFO --}}
                        <div
                            class="bg-white rounded-[24px] shadow-[0_5px_30px_rgba(0,0,0,0.05)] border border-gray-100 p-8">
                            <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-[#FF8C42]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-[#2D3436]">General Information</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama --}}
                                <div class="col-span-2">
                                    <label class="block text-xs font-bold text-[#636E72] uppercase mb-2 ml-1">Full
                                        Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-[14px] text-[#2D3436] font-medium focus:bg-white focus:border-[#FF8C42] focus:ring-0 transition outline-none"
                                        placeholder="Enter your full name">
                                </div>

                                {{-- Tanggal Lahir --}}
                                <div>
                                    <label class="block text-xs font-bold text-[#636E72] uppercase mb-2 ml-1">Date of
                                        Birth</label>
                                    <input type="date" name="date_of_birth"
                                        value="{{ old('date_of_birth', optional($user->date_of_birth)->format('Y-m-d')) }}"
                                        class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-[14px] text-[#2D3436] font-medium focus:bg-white focus:border-[#FF8C42] focus:ring-0 transition outline-none">
                                </div>

                                {{-- Phone --}}
                                <div>
                                    <label class="block text-xs font-bold text-[#636E72] uppercase mb-2 ml-1">Phone
                                        Number</label>
                                    <input type="tel" id="phoneInput" name="phone_number"
                                        value="{{ old('phone_number', $user->phone_number) }}"
                                        class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-[14px] text-[#2D3436] font-medium focus:bg-white focus:border-[#FF8C42] focus:ring-0 transition outline-none"
                                        placeholder="08xx-xxxx-xxxx" maxlength="15">
                                </div>

                                <div>
        <label class="block text-xs font-bold text-[#636E72] uppercase mb-2 ml-1">Student Email</label>
        <div class="flex w-full">
            <div class="relative flex-1">
                @php
                    $emailParts = explode('@', $user->email);
                    $username = $emailParts[0] ?? '';
                @endphp
                <input type="text" name="email_username"
                    value="{{ old('email_username', $username) }}"
                    class="w-full px-5 py-3.5 bg-gray-50 border border-r-0 border-gray-200 rounded-l-[14px] text-[#2D3436] font-medium focus:bg-white focus:border-[#FF8C42] focus:ring-0 transition outline-none text-right pr-2"
                    placeholder="username">
            </div>
            <div class="flex items-center px-3 md:px-5 py-3.5 bg-gray-100 border border-l-0 border-gray-200 rounded-r-[14px] text-[#636E72] font-medium select-none text-xs md:text-sm">
                @student.ciputra.ac.id
            </div>
        </div>
    </div>

    {{-- 5. GPA (Kanan) --}}
    <div>
        <label class="block text-xs font-bold text-[#636E72] uppercase mb-2 ml-1">GPA (IPK)</label>
        <input type="number" name="gpa" step="0.01" min="0" max="4.00"
            value="{{ old('gpa', $user->gpa) }}"
            class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-[14px] text-[#2D3436] font-medium focus:bg-white focus:border-[#FF8C42] focus:ring-0 transition outline-none"
            placeholder="3.xx">
    </div>

    {{-- 6. Major --}}
    <div>
        <label class="block text-xs font-bold text-[#636E72] uppercase mb-2 ml-1">Major</label>
        <div class="relative">
            <select name="major"
                class="w-full appearance-none px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-[14px] text-[#2D3436] font-medium focus:bg-white focus:border-[#FF8C42] focus:ring-0 transition outline-none cursor-pointer">
                <option value="" disabled {{ !$user->major_id ? 'selected' : '' }}>Select your major</option>
                @foreach($majors as $majorItem)
                    <option value="{{ $majorItem->id }}" {{ $user->major_id == $majorItem->id ? 'selected' : '' }}>
                        {{ $majorItem->name }}
                    </option>
                @endforeach
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- 7. Batch Year --}}
    <div>
        <label class="block text-xs font-bold text-[#636E72] uppercase mb-2 ml-1">Batch Year</label>
        <input type="number" name="batch" value="{{ old('batch', $user->batch) }}"
            class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-[14px] text-[#2D3436] font-medium focus:bg-white focus:border-[#FF8C42] focus:ring-0 transition outline-none"
            placeholder="202x">
    </div>
                                

                                {{-- ======================================================= --}}
                                {{-- SKILL SELECTOR (MULTI-SELECT PROFESSIONAL) --}}
                                {{-- ======================================================= --}}
                                <div class="col-span-2" x-data="skillSelector()">
                                    <label class="block text-xs font-bold text-[#636E72] uppercase mb-2 ml-1">
                                        Professional Skills <span class="text-orange-400 text-[10px] ml-1 normal-case font-normal">(Select multiple)</span>
                                    </label>
                                    
                                    <div class="relative">
                                        {{-- Input Container (Fake Input) --}}
                                        <div class="w-full min-h-[54px] px-2 py-2 bg-gray-50 border border-gray-200 rounded-[14px] focus-within:bg-white focus-within:border-[#FF8C42] transition flex flex-wrap gap-2 items-center cursor-text"
                                            @click="$refs.searchInput.focus()">
                                            
                                            {{-- Selected Tags (Chips) --}}
                                            <template x-for="(skill, index) in selectedSkills" :key="skill.id">
                                                <div class="flex items-center gap-1 bg-[#FF8C42]/10 text-[#FF8C42] px-3 py-1.5 rounded-lg text-xs font-bold border border-[#FF8C42]/20">
                                                    <span x-text="skill.name"></span>
                                                    <button type="button" @click.stop="removeSkill(index)" class="hover:text-red-500 transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                    {{-- Hidden Input agar terkirim ke Laravel --}}
                                                    <input type="hidden" name="skills[]" :value="skill.id">
                                                </div>
                                            </template>

                                            {{-- Search Input --}}
                                            <input type="text" x-ref="searchInput" x-model="search" 
                                                class="flex-1 bg-transparent border-none outline-none text-sm text-[#2D3436] placeholder-gray-400 min-w-[120px] px-2 py-1"
                                                placeholder="Type to search skills..."
                                                @keydown.escape="open = false"
                                                @click="open = true"
                                                @input="open = true">
                                        </div>

                                        {{-- Dropdown Suggestion --}}
                                        <div x-show="open" @click.away="open = false" x-transition 
                                            class="absolute z-50 w-full mt-2 bg-white rounded-[16px] shadow-xl border border-gray-100 max-h-60 overflow-y-auto custom-scrollbar">
                                            
                                            <template x-for="group in filteredGroups" :key="group.major">
                                                <div>
                                                    {{-- Group Header --}}
                                                    <div class="px-4 py-2 bg-gray-50 text-[10px] font-extrabold text-[#636E72] uppercase tracking-wider sticky top-0" x-text="group.major"></div>
                                                    
                                                    {{-- Skill Items --}}
                                                    <template x-for="skill in group.skills" :key="skill.id">
                                                        <div @click="addSkill(skill)" 
                                                            class="px-5 py-2.5 text-sm text-[#2D3436] hover:bg-orange-50 hover:text-[#FF8C42] cursor-pointer transition flex justify-between items-center group">
                                                            <span x-text="skill.name"></span>
                                                            <span x-show="isSelected(skill.id)" class="text-[#FF8C42] text-xs font-bold">Selected</span>
                                                        </div>
                                                    </template>
                                                </div>
                                            </template>

                                            {{-- Empty State --}}
                                            <div x-show="filteredGroups.length === 0" class="px-5 py-4 text-center text-sm text-gray-400">
                                                No skills found matching "<span x-text="search" class="font-bold"></span>"
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Helper Text --}}
                                    <p class="text-[10px] text-gray-400 mt-2 ml-1">
                                        Add skills relevant to your major to get better job recommendations.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- CARD 2: DOCUMENTS --}}
                        <div
                            class="bg-white rounded-[24px] shadow-[0_5px_30px_rgba(0,0,0,0.05)] border border-gray-100 p-8">
                            <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-[#2D3436]">Documents</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                {{-- 1. CV UPLOAD CARD --}}
                                <div
                                    class="bg-gray-50 rounded-[18px] p-5 border border-dashed border-gray-300 hover:border-[#FF8C42] transition-colors group">
                                    <label class="block text-xs font-bold text-[#636E72] uppercase mb-3">Curriculum
                                        Vitae</label>
                                    <div class="flex items-center gap-3">
                                        <label for="cv_file" id="cv_label" class="flex-1 cursor-pointer">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 group-hover:text-[#FF8C42] transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span
                                                        class="block text-sm font-bold text-[#2D3436] truncate w-32 md:w-40">
                                                        {{ $user->saved_cv_name ? $user->saved_cv_name : 'Upload PDF' }}
                                                    </span>
                                                    <span class="text-[10px] text-gray-400">Max 5MB</span>
                                                </div>
                                            </div>
                                            <input type="file" name="cv_file" id="cv_file" accept=".pdf"
                                                class="hidden"
                                                onchange="handleFileUpload(this, 'cv_label', 'btn_view_cv')">
                                        </label>

                                        {{-- View Button --}}
                                        <button type="button" id="btn_view_cv"
                                            onclick="viewPdf('{{ $user->saved_cv_name ? asset('storage/documents/' . $user->saved_cv_name) : '' }}')"
                                            class="{{ $user->saved_cv_name ? '' : 'hidden' }} w-9 h-9 bg-white border border-gray-200 rounded-full flex items-center justify-center text-[#636E72] hover:text-[#FF8C42] hover:border-[#FF8C42] transition shadow-sm"
                                            title="View CV">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- 2. PORTFOLIO UPLOAD CARD --}}
                                <div
                                    class="bg-gray-50 rounded-[18px] p-5 border border-dashed border-gray-300 hover:border-[#FF8C42] transition-colors group">
                                    <label class="block text-xs font-bold text-[#636E72] uppercase mb-3">Portfolio</label>
                                    <div class="flex items-center gap-3">
                                        <label for="portfolio_file" id="porto_label" class="flex-1 cursor-pointer">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 group-hover:text-[#FF8C42] transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span
                                                        class="block text-sm font-bold text-[#2D3436] truncate w-32 md:w-40">
                                                        {{ $user->saved_portfolio_name ? $user->saved_portfolio_name : 'Upload PDF' }}
                                                    </span>
                                                    <span class="text-[10px] text-gray-400">Max 5MB</span>
                                                </div>
                                            </div>
                                            <input type="file" name="portfolio_file" id="portfolio_file"
                                                accept=".pdf" class="hidden"
                                                onchange="handleFileUpload(this, 'porto_label', 'btn_view_porto')">
                                        </label>

                                        {{-- View Button --}}
                                        <button type="button" id="btn_view_porto"
                                            onclick="viewPdf('{{ $user->saved_portfolio_name ? asset('storage/documents/' . $user->saved_portfolio_name) : '' }}')"
                                            class="{{ $user->saved_portfolio_name ? '' : 'hidden' }} w-9 h-9 bg-white border border-gray-200 rounded-full flex items-center justify-center text-[#636E72] hover:text-[#FF8C42] hover:border-[#FF8C42] transition shadow-sm"
                                            title="View Portfolio">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- SAVE BUTTON --}}
                        <div class="flex justify-end pt-4">
                            <button type="button" onclick="confirmAction('profile')"
                                class="w-full md:w-auto px-10 py-4 rounded-full bg-[#2D3436] hover:bg-black text-white font-bold text-base shadow-[0_10px_20px_rgba(45,52,54,0.3)] hover:shadow-xl hover:-translate-y-1 transition transform duration-200 flex items-center justify-center gap-2">
                                Save Profile Changes
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ===================== MODALS (TIDAK BERUBAH) ===================== --}}

    {{-- 1. MODAL PREVIEW PDF (IFRAME) --}}
    <div id="pdfModal" class="fixed inset-0 z-[1500] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closePdfModal()"></div>
        <div
            class="bg-white rounded-[24px] w-full max-w-4xl h-[85vh] relative flex flex-col shadow-2xl overflow-hidden z-10">
            <div class="flex justify-between items-center p-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-lg text-[#2D3436]">Document Preview</h3>
                <button onclick="closePdfModal()"
                    class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition"><svg
                        class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg></button>
            </div>
            <div class="flex-1 bg-gray-100 p-0 overflow-hidden relative">
                <iframe id="pdfViewerFrame" src="" class="w-full h-full border-0"></iframe>
                <div id="pdfLoading" class="absolute inset-0 flex items-center justify-center bg-white z-10 hidden">
                    <div class="w-10 h-10 border-4 border-orange-100 border-t-[#FF8C42] rounded-full animate-spin"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. MODAL ERROR FILE SIZE --}}
    <div id="fileErrorModal" class="fixed inset-0 z-[1600] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeFileErrorModal()">
        </div>
        <div class="bg-white rounded-[24px] w-full max-w-xs p-6 relative transform scale-100 shadow-2xl z-10 text-center">
            <div class="w-14 h-14 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 text-[#FF3B30]"><svg
                    class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg></div>
            <h3 class="text-lg font-bold text-[#2D3436] mb-1">File Too Large</h3>
            <p class="text-[#636E72] text-sm mb-6">Maximum file size allowed is 5MB. Please upload a smaller PDF.</p>
            <button onclick="closeFileErrorModal()"
                class="w-full py-2.5 rounded-full bg-[#2D3436] text-white font-bold text-sm hover:bg-black transition">OK,
                I Understand</button>
        </div>
    </div>

    {{-- 3. MODAL CHANGE PASSWORD --}}
    <div id="passwordModal" class="fixed inset-0 z-[1000] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closePasswordModal()">
        </div>
        <div class="bg-white rounded-[24px] w-full max-w-md p-8 relative transform scale-100 shadow-2xl z-10">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-[#2D3436]">Change Password</h3>
                <button onclick="closePasswordModal()" class="text-gray-400 hover:text-[#FF8C42]"><svg class="w-6 h-6"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg></button>
            </div>
            <form id="passwordForm">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#636E72] mb-2">Old Password</label>
                    <div id="box_current_password"
                        class="flex items-center px-4 py-3 border border-[#EFF0F6] rounded-[15px] bg-gray-50 focus-within:border-[#FF8C42] transition">
                        <input type="password" name="current_password" id="input_current"
                            class="w-full outline-none text-[#2D3436] bg-transparent" placeholder="Enter old password">
                    </div>
                    <p id="error_current_password" class="text-red-500 text-xs mt-1 ml-1 font-medium hidden"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#636E72] mb-2">New Password</label>
                    <div id="box_new_password"
                        class="flex items-center px-4 py-3 border border-[#EFF0F6] rounded-[15px] bg-white focus-within:border-[#FF8C42] transition">
                        <input type="password" name="new_password" id="input_new"
                            class="w-full outline-none text-[#2D3436]" placeholder="Ex: P@ssw0rd123">
                    </div>
                    <p id="error_new_password"
                        class="text-red-500 text-xs mt-1 ml-1 font-medium hidden flex flex-col gap-1"></p>
                </div>
                <div class="mb-8">
                    <label class="block text-sm font-medium text-[#636E72] mb-2">Repeat New Password</label>
                    <div id="box_confirm"
                        class="flex items-center px-4 py-3 border border-[#EFF0F6] rounded-[15px] bg-white focus-within:border-[#FF8C42] transition">
                        <input type="password" name="new_password_confirmation" id="input_confirm"
                            class="w-full outline-none text-[#2D3436]" placeholder="Re-enter new password">
                    </div>
                </div>
                <button type="button" onclick="confirmAction('password')"
                    class="w-full py-3.5 rounded-[30px] bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold text-base shadow-md hover:shadow-lg transition">Save
                    Password</button>
            </form>
        </div>
    </div>

    {{-- 4. MODAL CONFIRMATION --}}
    <div id="confirmModal" class="fixed inset-0 z-[1100] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeConfirmModal()"></div>
        <div class="bg-white rounded-[24px] w-full max-w-sm p-6 relative transform scale-100 shadow-2xl z-10 text-center">
            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4 text-[#FF8C42]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#2D3436] mb-2">Are you sure?</h3>
            <p class="text-[#636E72] text-sm mb-6">Do you want to proceed with this action?</p>
            <div class="flex gap-3">
                <button onclick="closeConfirmModal()"
                    class="flex-1 py-3 rounded-[15px] border border-[#B2B2B2] text-[#636E72] font-bold text-sm hover:bg-gray-50 transition">Cancel</button>
                <button onclick="submitFinal()"
                    class="flex-1 py-3 rounded-[15px] bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold text-sm shadow-md hover:shadow-lg transition">Yes,
                    Save</button>
            </div>
        </div>
    </div>

    {{-- 5. LOADING & SUCCESS MODALS --}}
    <div id="loadingModal" class="fixed inset-0 z-[1200] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>
        <div class="bg-white rounded-[20px] p-6 flex flex-col items-center justify-center shadow-2xl z-20 relative">
            <div class="w-12 h-12 border-4 border-orange-100 border-t-[#FF8C42] rounded-full animate-spin mb-4"></div>
            <p class="text-[#2D3436] font-bold text-base">Processing...</p>
        </div>
    </div>
    <div id="successModalAjax" class="fixed inset-0 z-[1300] hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeSuccessModalAjax()">
        </div>
        <div class="bg-white rounded-[24px] w-full max-w-sm p-8 relative transform scale-100 shadow-2xl z-10 text-center">
            <div
                class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 text-green-500 animate-bounce">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg></div>
            <h3 class="text-2xl font-bold text-[#2D3436] mb-2">Success!</h3>
            <p id="successMessage" class="text-[#636E72] text-sm mb-8">Action completed successfully.</p><button
                onclick="closeSuccessModalAjax()"
                class="w-full py-3 rounded-[15px] bg-[#2D3436] text-white font-bold text-sm hover:bg-black transition">Close</button>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- JAVASCRIPT ASLI DARI ANDA (TIDAK SAYA UBAH APAPUN) --}}
    <script>
        // --- 1. FILE UPLOAD & PREVIEW LOGIC (CORE) ---
        function handleFileUpload(input, labelId, btnViewId) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileSize = file.size / 1024 / 1024; // Convert bytes to MB

                // Validasi Ukuran (Max 5MB)
                if (fileSize > 5) {
                    document.getElementById('fileErrorModal').classList.remove('hidden'); // Show error modal
                    input.value = ""; // Reset input
                    return;
                }

                // Validasi Tipe (Opsional, browser accept=".pdf" sudah filter di awal)
                if (file.type !== "application/pdf") {
                    alert("Please upload PDF files only.");
                    input.value = "";
                    return;
                }

                // Update Label Text (Nama File)
                const label = document.getElementById(labelId);
                label.querySelector('span').innerText = file.name;

                // Generate Blob URL untuk Live Preview
                const blobUrl = URL.createObjectURL(file);

                // Update Tombol View
                const btnView = document.getElementById(btnViewId);
                btnView.classList.remove('hidden'); // Munculkan tombol
                btnView.onclick = function() { // Override onclick agar buka blobUrl
                    viewPdf(blobUrl);
                };
            }
        }

        function closeFileErrorModal() {
            document.getElementById('fileErrorModal').classList.add('hidden');
        }

        function viewPdf(url) {
            const modal = document.getElementById('pdfModal');
            const frame = document.getElementById('pdfViewerFrame');
            const loading = document.getElementById('pdfLoading');

            if (!url) return; // Guard clause

            modal.classList.remove('hidden');
            loading.classList.remove('hidden');

            frame.src = url;
            frame.onload = function() {
                loading.classList.add('hidden');
            };
        }

        function closePdfModal() {
            document.getElementById('pdfModal').classList.add('hidden');
            document.getElementById('pdfViewerFrame').src = "";
        }

        // --- 2. UTILS LAIN ---
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('photoPreview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        const phoneInput = document.getElementById('phoneInput');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 4) value = value.slice(0, 4) + '-' + value.slice(4);
                if (value.length > 9) value = value.slice(0, 9) + '-' + value.slice(9);
                e.target.value = value;
            });
        }

        // --- 3. MODAL LOGIC (PASSWORD & CONFIRM) ---
        let currentAction = '';

        function openPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
            resetPasswordErrors();
            document.getElementById('passwordForm').reset();
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
        }

        function confirmAction(type) {
            currentAction = type;
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function closeSuccessModalAjax() {
            document.getElementById('successModalAjax').classList.add('hidden');
            if (currentAction === 'password') closePasswordModal();
        }

        // --- 4. RESET ERROR ---
        function resetPasswordErrors() {
            ['err_current', 'err_new'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.innerHTML = '';
                    el.classList.add('hidden');
                }
            });
            ['box_current', 'box_new'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.classList.remove('border-red-500', 'bg-red-50');
                    el.classList.add('border-[#EFF0F6]');
                }
            });
        }

        // --- 5. SUBMIT CONTROLLER ---
        function submitFinal() {
            closeConfirmModal();
            document.getElementById('loadingModal').classList.remove('hidden');

            if (currentAction === 'profile') {
                document.getElementById('profileForm').submit();
            } else if (currentAction === 'password') {
                handlePasswordSubmit();
            }
        }

        // --- 6. AJAX PASSWORD ---
        function handlePasswordSubmit() {
            const form = document.getElementById('passwordForm');
            const formData = new FormData(form);
            resetPasswordErrors();

            fetch("{{ route('user.password') }}", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async response => {
                    const data = await response.json();
                    return {
                        status: response.status,
                        body: data
                    };
                })
                .then(result => {
                    document.getElementById('loadingModal').classList.add('hidden');

                    if (result.status === 200) {
                        document.getElementById('successMessage').innerText = result.body.message;
                        document.getElementById('successModalAjax').classList.remove('hidden');
                    } else if (result.status === 422) {
                        const errors = result.body.errors;
                        if (errors.current_password) {
                            showErrorField('error_current_password', 'box_current_password', errors.current_password[
                                0]);
                        }
                        if (errors.new_password) {
                            let msg = Array.isArray(errors.new_password) ? errors.new_password.join('<br>') : errors
                                .new_password;
                            showErrorField('error_new_password', 'box_new_password', msg);
                        }
                    } else {
                        console.error(result);
                    }
                })
                .catch(error => {
                    document.getElementById('loadingModal').classList.add('hidden');
                    console.error(error);
                });
        }

        function showErrorField(textId, boxId, msg) {
            const txt = document.getElementById(textId);
            const box = document.getElementById(boxId);
            txt.innerHTML = msg;
            txt.classList.remove('hidden');
            box.classList.remove('border-[#EFF0F6]');
            box.classList.add('border-red-500', 'bg-red-50');
        }

        // Auto show success for profile update
        @if (session('success'))
            document.getElementById('successMessage').innerText = "{{ session('success') }}";
            document.getElementById('successModalAjax').classList.remove('hidden');
        @endif
        function skillSelector() {
    return {
        open: false,
        search: '',
        // Data Awal dari Laravel
        allGroups: @json($majors->map(function($major) {
            return [
                'major' => $major->name,
                'skills' => $major->skills->map(function($skill) {
                    return ['id' => $skill->id, 'name' => $skill->name];
                })
            ];
        })),
        
        // PERBAIKAN DISINI: Gunakan 'userSkills' agar tidak bentrok dengan kolom string
        selectedSkills: @json($user->userSkills->map(function($skill) {
            return ['id' => $skill->id, 'name' => $skill->name];
        })),

        get filteredGroups() {
            if (this.search === '') {
                return this.allGroups;
            }
            
            return this.allGroups.map(group => {
                const filteredSkills = group.skills.filter(skill => 
                    skill.name.toLowerCase().includes(this.search.toLowerCase())
                );
                return { ...group, skills: filteredSkills };
            }).filter(group => group.skills.length > 0);
        },

        addSkill(skill) {
            if (!this.selectedSkills.some(s => s.id === skill.id)) {
                this.selectedSkills.push(skill);
            }
            this.search = ''; 
            this.$refs.searchInput.focus(); 
        },

        removeSkill(index) {
            this.selectedSkills.splice(index, 1);
        },

        isSelected(id) {
            return this.selectedSkills.some(s => s.id === id);
        }
    }
}
    </script>
@endpush
