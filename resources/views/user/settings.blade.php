@extends('layouts.app')

@section('content')
    <div class="bg-[#F9FAFB] min-h-screen font-poppins relative pb-20">

        {{-- TOAST NOTIFICATION --}}
        <div id="toast" class="fixed top-24 right-5 md:right-10 bg-[#2D3436] text-white px-6 py-4 rounded-[16px] shadow-2xl z-[2000] transition-all duration-300 opacity-0 translate-x-10 flex items-center gap-3 border border-gray-700">
            <div class="w-6 h-6 bg-[#4CD964] rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-sm">Success</h4>
                <p class="text-xs text-gray-300">Settings updated successfully.</p>
            </div>
        </div>

        {{-- 1. HEADER SECTION --}}
        <div class="h-[280px] w-full bg-[#1E1E1E] relative overflow-hidden">
            <div class="absolute inset-0 bg-[linear-gradient(135deg,#FF8C42_0%,#FF3E8D_100%)] opacity-90"></div>
            <div class="absolute top-[-50%] left-[-20%] w-[600px] h-[600px] bg-white opacity-10 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="container mx-auto px-4 md:px-20 relative z-10 h-full flex flex-col justify-center">
                
                {{-- Breadcrumb Back --}}
                <div class="mb-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-white/80 hover:text-white transition-colors text-sm font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Back to Dashboard
                    </a>
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2 tracking-tight">Settings & Privacy</h1>
                <p class="text-white/90 text-sm md:text-base max-w-xl font-light">Manage your notifications, security preferences, and account visibility.</p>
            </div>
        </div>

        {{-- 2. MAIN CONTENT --}}
        <div class="container mx-auto px-4 md:px-20 relative -mt-20 z-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- SIDEBAR NAVIGATION (Desktop Only - Optional Visual) --}}
                <div class="hidden lg:block col-span-1">
                    <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100 sticky top-28">
                        <h3 class="text-xs font-bold text-[#636E72] uppercase tracking-wider mb-4 ml-2">Quick Jump</h3>
                        <nav class="space-y-1">
                            <a href="#notifications" class="flex items-center gap-3 px-4 py-3 bg-orange-50 text-[#FF8C42] rounded-xl font-bold text-sm transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                Notifications
                            </a>
                            <a href="#privacy" class="flex items-center gap-3 px-4 py-3 text-[#636E72] hover:bg-gray-50 hover:text-[#2D3436] rounded-xl font-medium text-sm transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Privacy & Security
                            </a>
                            <a href="#general" class="flex items-center gap-3 px-4 py-3 text-[#636E72] hover:bg-gray-50 hover:text-[#2D3436] rounded-xl font-medium text-sm transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                General
                            </a>
                        </nav>
                        
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <p class="text-xs text-gray-400 mb-4">Need help? Contact support.</p>
                            <a href="mailto:support@uchub.com" class="block w-full py-3 bg-[#2D3436] hover:bg-black text-white text-center rounded-xl font-bold text-sm shadow-md transition">Contact Support</a>
                        </div>
                    </div>
                </div>

                {{-- SETTINGS CONTENT --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- SECTION 1: NOTIFICATIONS --}}
                    <section id="notifications" class="bg-white rounded-[24px] shadow-[0_5px_30px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 flex items-center gap-4 bg-gray-50/50">
                            <div class="w-10 h-10 rounded-full bg-orange-100 text-[#FF8C42] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-[#2D3436]">Notifications</h3>
                                <p class="text-xs text-[#636E72]">Manage how you receive alerts and updates.</p>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-50">
                            {{-- Job Alerts --}}
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                                <div>
                                    <h4 class="text-sm font-bold text-[#2D3436]">New Job Alerts</h4>
                                    <p class="text-xs text-[#636E72] mt-1">Get notified when new jobs match your major.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" onchange="updateSetting('notify_job_alerts', this.checked)" {{ Auth::user()->notify_job_alerts ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF8C42]"></div>
                                </label>
                            </div>

                            {{-- Application Status --}}
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                                <div>
                                    <h4 class="text-sm font-bold text-[#2D3436]">Application Status</h4>
                                    <p class="text-xs text-[#636E72] mt-1">Updates on your interviews & application results.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" onchange="updateSetting('notify_app_status', this.checked)" {{ Auth::user()->notify_app_status ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF8C42]"></div>
                                </label>
                            </div>

                            {{-- News --}}
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                                <div>
                                    <h4 class="text-sm font-bold text-[#2D3436]">News & Tips</h4>
                                    <p class="text-xs text-[#636E72] mt-1">Receive career advice and UC HUB newsletters.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" onchange="updateSetting('notify_news', this.checked)" {{ Auth::user()->notify_news ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF8C42]"></div>
                                </label>
                            </div>
                        </div>
                    </section>

                    {{-- SECTION 2: PRIVACY & SECURITY --}}
                    <section id="privacy" class="bg-white rounded-[24px] shadow-[0_5px_30px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 flex items-center gap-4 bg-gray-50/50">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-[#2D3436]">Privacy & Security</h3>
                                <p class="text-xs text-[#636E72]">Control your profile visibility and security.</p>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-50">
                            {{-- Profile Visibility --}}
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                                <div>
                                    <h4 class="text-sm font-bold text-[#2D3436]">Profile Visibility</h4>
                                    <p class="text-xs text-[#636E72] mt-1">Allow recruiters to find and view your profile.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" onchange="updateSetting('is_visible_to_recruiters', this.checked)" {{ Auth::user()->is_visible_to_recruiters ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#4CD964]"></div>
                                </label>
                            </div>

                            {{-- 2FA (Dummy) --}}
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                                <div>
                                    <h4 class="text-sm font-bold text-[#2D3436]">Two-Factor Authentication</h4>
                                    <p class="text-xs text-[#636E72] mt-1">Add an extra layer of security to your account.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer" onclick="alert('This feature will be available soon!')">
                                    <input type="checkbox" class="sr-only peer" disabled>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full cursor-not-allowed opacity-60 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                </label>
                            </div>
                        </div>
                    </section>

                    {{-- SECTION 3: GENERAL --}}
                    <section id="general" class="bg-white rounded-[24px] shadow-[0_5px_30px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 flex items-center gap-4 bg-gray-50/50">
                            <div class="w-10 h-10 rounded-full bg-gray-200 text-[#2D3436] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-[#2D3436]">General</h3>
                                <p class="text-xs text-[#636E72]">App preferences and account actions.</p>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-50">
                            {{-- Language --}}
                            <button onclick="alert('Multi-language feature coming soon!')" class="w-full text-left p-6 flex items-center justify-between hover:bg-gray-50 transition group">
                                <div>
                                    <h4 class="text-sm font-bold text-[#2D3436]">Language</h4>
                                    <p class="text-xs text-[#636E72] mt-1">Select your preferred language.</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-[#2D3436]">English (US)</span>
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-[#FF8C42] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </button>

                            {{-- Dark Mode (Dummy) --}}
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                                <div>
                                    <h4 class="text-sm font-bold text-[#2D3436]">Dark Mode</h4>
                                    <p class="text-xs text-[#636E72] mt-1">Switch between light and dark themes.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer" onclick="alert('Dark Mode feature coming soon!')">
                                    <input type="checkbox" class="sr-only peer" disabled>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full cursor-not-allowed opacity-60 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                </label>
                            </div>

                            {{-- Delete Account --}}
                            <button onclick="openDeleteModal()" class="w-full text-left p-6 flex items-center justify-between hover:bg-red-50 transition group">
                                <div>
                                    <h4 class="text-sm font-bold text-[#FF3B30]">Delete Account</h4>
                                    <p class="text-xs text-[#FF3B30]/70 mt-1">Permanently remove your account and data.</p>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-[#FF3B30] group-hover:bg-[#FF3B30] group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </div>
                            </button>
                        </div>
                    </section>

                    {{-- FOOTER INFO --}}
                    <div class="text-center pt-4">
                        <p class="text-xs text-gray-400">UC HUB App Version 2.0.1</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE ACCOUNT --}}
    <div id="deleteModal" class="fixed inset-0 z-[3000] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>
        <div class="bg-white rounded-[24px] w-full max-w-sm p-8 relative transform scale-100 shadow-2xl z-10 text-center animate-fade-in-up">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-5 text-[#FF3B30]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-[#2D3436] mb-2">Delete Account?</h3>
            <p class="text-[#636E72] text-sm mb-8 leading-relaxed">This action cannot be undone. All your data, applications, and saved jobs will be permanently removed.</p>

            <div class="flex flex-col gap-3">
                <form action="{{ route('account.delete') }}" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3.5 rounded-full bg-[#FF3B30] text-white font-bold text-sm shadow-[0_4px_10px_rgba(255,59,48,0.3)] hover:shadow-lg hover:bg-red-600 transition">Delete Permanently</button>
                </form>
                <button onclick="closeDeleteModal()" class="w-full py-3.5 rounded-full border border-gray-200 text-[#636E72] font-bold text-sm hover:bg-gray-50 transition">Cancel</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // --- 1. AJAX SETTINGS UPDATE ---
        function updateSetting(key, value) {
            fetch("{{ route('settings.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        key: key,
                        value: value ? 1 : 0
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast();
                    } else {
                        alert('Failed to update settings. Please try again.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // --- 2. TOAST NOTIFICATION ---
        function showToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('opacity-0', 'translate-x-10'); // Show
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-x-10'); // Hide after 3s
            }, 3000);
        }

        // --- 3. DELETE MODAL LOGIC ---
        function openDeleteModal() { document.getElementById('deleteModal').classList.remove('hidden'); }
        function closeDeleteModal() { document.getElementById('deleteModal').classList.add('hidden'); }
    </script>
@endpush