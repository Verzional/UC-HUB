<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UC HUB</title>
    @vite('resources/css/app.css')

    {{-- 1. CSS Slider (CDN) & Alpine --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        
        /* Slider Custom Style */
        .noUi-target { background-color: #EEEEEE !important; border: none !important; box-shadow: none !important; height: 6px !important; }
        .noUi-connect { background: #FF8C42 !important; }
        .noUi-handle { width: 18px !important; height: 18px !important; border-radius: 50% !important; border: 2px solid #FF8C42 !important; background-color: #FFFFFF !important; box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important; right: -9px !important; top: -6px !important; }
        .noUi-handle:before, .noUi-handle:after { display: none !important; }
    </style>
</head>

<body class="bg-[#F9FAFB] text-[#2D3436] font-poppins flex flex-col min-h-screen">

    {{-- ================================================================= --}}
    {{-- NAVBAR --}}
    {{-- ================================================================= --}}
    <nav class="fixed top-0 w-full z-50 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-gray-100" id="mainNavbar">
        <div class="container mx-auto px-4 md:px-10 lg:px-20 h-20 flex items-center justify-between">
            
            {{-- 1. LOGO --}}
            <a href="/" class="flex items-center gap-2 group z-50 relative shrink-0">
                <div class="w-10 h-10 rounded-full bg-[linear-gradient(135deg,#FF8C42_0%,#FF3E8D_100%)] flex items-center justify-center text-white font-extrabold text-lg shadow-lg group-hover:shadow-orange-200 transition-all duration-300">
                    UC
                </div>
                <span class="text-2xl font-extrabold text-[#2D3436] tracking-tight group-hover:text-[#FF8C42] transition-colors">
                    UC HUB
                </span>
            </a>

            {{-- 2. DESKTOP MENU (ID: desktopMenu) --}}
            <div id="desktopMenu" class="hidden md:flex items-center gap-6 lg:gap-8 justify-center flex-1 mx-4">
                <a href="{{ route('home') }}" class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('home') ? 'text-[#FF8C42]' : 'text-[#636E72] hover:text-[#2D3436]' }} transition-colors">
                    Home
                </a>
                <a href="{{ route('jobs.index') }}" 
                   class="text-sm font-bold whitespace-nowrap {{ (request()->routeIs('jobs.index') || request()->routeIs('jobs.show')) ? 'text-[#FF8C42]' : 'text-[#636E72] hover:text-[#2D3436]' }} transition-colors">
                    Find Jobs
                </a>
                
                <a href="{{ route('jobs.saved') }}" 
                   onclick="{{ auth()->guest() ? 'event.preventDefault(); openGlobalAuthModal();' : '' }}"
                   class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('jobs.saved') ? 'text-[#FF8C42]' : 'text-[#636E72] hover:text-[#2D3436]' }} transition-colors cursor-pointer">
                   Saved Jobs
                </a>
                <a href="{{ route('applications.index') }}" 
                   onclick="{{ auth()->guest() ? 'event.preventDefault(); openGlobalAuthModal();' : '' }}"
                   class="text-sm font-bold whitespace-nowrap {{ request()->routeIs('applications.*') ? 'text-[#FF8C42]' : 'text-[#636E72] hover:text-[#2D3436]' }} transition-colors cursor-pointer">
                   My Applications
                </a>
            </div>

            {{-- 3. RIGHT SECTION (Auth + Burger) --}}
            <div class="flex items-center gap-3 z-50 relative shrink-0">
                
                {{-- A. AUTH BUTTONS (ID: desktopAuth) --}}
                @guest
                    <div id="desktopAuth" class="hidden md:flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-[#2D3436] hover:text-[#FF8C42] transition px-4 whitespace-nowrap">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-[#2D3436] hover:bg-black text-white text-sm font-bold py-2.5 px-6 rounded-full shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition duration-200 whitespace-nowrap">
                            Sign Up
                        </a>
                    </div>
                @else
                    {{-- B. PROFILE DROPDOWN (Selalu Muncul) --}}
                    <div class="relative" id="profileMenuContainer">
                        <button onclick="toggleProfileMenu()" class="flex items-center gap-2 bg-white pl-1 pr-2 py-1 rounded-full border border-gray-100 hover:border-orange-100 shadow-sm transition focus:outline-none group">
                            <div class="w-9 h-9 rounded-full p-0.5 border border-gray-100 group-hover:border-[#FF8C42] transition">
                                <img src="{{ Auth::user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=FF8C42&color=fff' }}" 
                                     alt="Profile" class="w-full h-full rounded-full object-cover">
                            </div>
                            <span class="font-bold text-sm hidden md:block text-[#2D3436] group-hover:text-[#FF8C42] transition max-w-[100px] truncate">
                                {{ Auth::user()->name }}
                            </span>
                            <svg id="chevronIcon" class="w-4 h-4 text-gray-400 group-hover:text-[#FF8C42] transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div id="profileDropdown" class="hidden absolute right-0 top-full mt-3 w-60 bg-white rounded-[20px] shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden z-50 transform origin-top-right transition-all animate-fade-in-up">
                            <div class="p-2 space-y-1">
                                <div class="px-4 py-2 border-b border-gray-50 mb-1">
                                    <p class="text-[10px] uppercase font-bold text-gray-400">Signed in as</p>
                                    <p class="text-sm font-bold text-[#2D3436] truncate">{{ Auth::user()->name }}</p>
                                </div>
                                <a href="{{ route('user.account') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-[14px] hover:bg-orange-50 group transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span class="text-sm font-medium text-[#636E72] group-hover:text-[#2D3436]">My Account</span>
                                </a>
                                <a href="{{ route('user.settings') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-[14px] hover:bg-orange-50 group transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-[#FF8C42]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="text-sm font-medium text-[#636E72] group-hover:text-[#2D3436]">Settings</span>
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 px-4 py-2.5 w-full rounded-[14px] hover:bg-red-50 group transition-colors text-left mt-1">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-[#FF3B30]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        <span class="text-sm font-bold text-[#636E72] group-hover:text-[#FF3B30]">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest

                {{-- C. BURGER BUTTON (ID: burgerContainer) --}}
                <div id="burgerContainer" class="relative md:hidden">
                    <button onclick="toggleMobileMenu()" class="p-2.5 rounded-full bg-white border border-gray-100 hover:bg-gray-50 text-[#2D3436] transition focus:outline-none shadow-sm">
                        {{-- Icon Hamburger --}}
                        <svg class="w-6 h-6" id="burgerIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        {{-- Icon Close --}}
                        <svg class="w-6 h-6 hidden" id="closeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    {{-- POPUP MOBILE MENU --}}
                    <div id="mobileMenuPopup" class="hidden absolute top-full right-0 mt-3 w-56 bg-white rounded-[24px] shadow-[0_10px_40px_rgba(0,0,0,0.15)] border border-gray-100 p-2 flex-col gap-1 transform origin-top-right transition-all duration-200 z-[60]">
                        
                        <a href="{{ route('home') }}" class="block px-4 py-3 rounded-[16px] {{ request()->routeIs('home') ? 'bg-orange-50 text-[#FF8C42]' : 'text-[#636E72] hover:bg-gray-50 hover:text-[#2D3436]' }} font-bold text-sm transition">
                            Home
                        </a>
                        <a href="{{ route('jobs.index') }}" class="block px-4 py-3 rounded-[16px] {{ request()->routeIs('jobs.*') ? 'bg-orange-50 text-[#FF8C42]' : 'text-[#636E72] hover:bg-gray-50 hover:text-[#2D3436]' }} font-bold text-sm transition">
                            Find Jobs
                        </a>
                        
                        <div class="h-px bg-gray-100 mx-2 my-1"></div>

                        <a href="{{ route('jobs.saved') }}" 
                           onclick="{{ auth()->guest() ? 'event.preventDefault(); openGlobalAuthModal();' : '' }}"
                           class="block px-4 py-3 rounded-[16px] {{ request()->routeIs('jobs.saved') ? 'bg-orange-50 text-[#FF8C42]' : 'text-[#636E72] hover:bg-gray-50 hover:text-[#2D3436]' }} font-bold text-sm transition">
                            Saved Jobs
                        </a>
                        <a href="{{ route('applications.index') }}" 
                           onclick="{{ auth()->guest() ? 'event.preventDefault(); openGlobalAuthModal();' : '' }}"
                           class="block px-4 py-3 rounded-[16px] {{ request()->routeIs('applications.*') ? 'bg-orange-50 text-[#FF8C42]' : 'text-[#636E72] hover:bg-gray-50 hover:text-[#2D3436]' }} font-bold text-sm transition">
                            My Applications
                        </a>

                        @guest
                            <div class="h-px bg-gray-100 mx-2 my-1"></div>
                            <a href="{{ route('login') }}" class="block px-4 py-3 rounded-[16px] text-center bg-[#2D3436] text-white font-bold text-sm hover:bg-black transition mt-1">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="block px-4 py-3 rounded-[16px] text-center border border-[#2D3436] text-[#2D3436] font-bold text-sm hover:bg-gray-50 transition mt-1">
                                Register
                            </a>
                        @endguest
                    </div>
                </div>

            </div>
        </div>
    </nav>

    {{-- ================================================================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ================================================================= --}}
    <main class="flex-grow pt-20"> 
        @yield('content')
    </main>

    {{-- ================================================================= --}}
    {{-- GLOBAL MODAL --}}
    {{-- ================================================================= --}}
    <div id="globalAuthModal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeGlobalAuthModal()"></div>
        <div class="bg-white rounded-[24px] w-full max-w-sm p-8 relative text-center transform transition-all scale-100 z-10 shadow-2xl">
            <button onclick="closeGlobalAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-[#FF8C42] transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-5 text-[#FF8C42]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg></div>
            <h3 class="text-2xl font-bold text-[#2D3436] mb-2">Login Required</h3>
            <p class="text-[#636E72] mb-8 text-sm">Please login to access this feature.</p>
            <div class="space-y-3">
                <a href="{{ route('login') }}" class="block w-full py-3 rounded-full bg-[linear-gradient(90deg,#FF8C42_0%,#FF3E8D_100%)] text-white font-bold shadow-md hover:shadow-lg transition">Login</a>
                <a href="{{ route('register') }}" class="block w-full py-3 rounded-full border border-[#FF8C42] text-[#FF8C42] font-bold hover:bg-orange-50 transition">Create Account</a>
            </div>
        </div>
    </div>

    {{-- ================================================================= --}}
    {{-- FOOTER --}}
    {{-- ================================================================= --}}
    <footer class="bg-white border-t border-gray-100 pt-16 pb-8 mt-auto">
        <div class="container mx-auto px-4 md:px-20">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-full bg-[linear-gradient(135deg,#FF8C42_0%,#FF3E8D_100%)] flex items-center justify-center text-white font-bold shadow-md">UC</div>
                        <span class="text-xl font-extrabold text-[#2D3436]">UC HUB</span>
                    </div>
                    <p class="text-[#636E72] text-sm leading-relaxed mb-6">Bridging the gap between University Ciputra talent and world-class opportunities.</p>
                </div>
                <div>
                    <h4 class="font-bold text-[#2D3436] mb-5">Platform</h4>
                    <ul class="space-y-3 text-sm text-[#636E72]">
                        <li><a href="#" class="hover:text-[#FF8C42] transition">For Students</a></li>
                        <li><a href="#" class="hover:text-[#FF8C42] transition">For Companies</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#2D3436] mb-5">Support</h4>
                    <ul class="space-y-3 text-sm text-[#636E72]">
                        <li><a href="#" class="hover:text-[#FF8C42] transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-[#FF8C42] transition">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#2D3436] mb-5">Stay Updated</h4>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Email address" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#FF8C42] transition">
                        <button class="bg-[#2D3436] hover:bg-black text-white px-4 py-2.5 rounded-lg text-sm font-bold transition">Join</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-[#9CA3AF]">
                <p>&copy; 2025 UC HUB. All rights reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-[#2D3436]">Privacy Policy</a>
                    <a href="#" class="hover:text-[#2D3436]">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // --- 1. CHECK SCREEN SIZE (SAFETY FUNCTION) ---
        // Fungsi ini memaksa elemen tampil/sembunyi berdasarkan ukuran layar asli
        function checkScreenSize() {
            if (window.innerWidth >= 768) { // md breakpoint (768px ke atas = Desktop/Tablet)
                // Mode Desktop: Tampilkan Menu Desktop, Sembunyikan Burger
                
                const desktopMenu = document.getElementById('desktopMenu');
                const desktopAuth = document.getElementById('desktopAuth');
                const burgerContainer = document.getElementById('burgerContainer');
                const mobilePopup = document.getElementById('mobileMenuPopup');

                if (desktopMenu) {
                    desktopMenu.classList.remove('hidden');
                    desktopMenu.classList.add('flex');
                }
                if (desktopAuth) {
                    desktopAuth.classList.remove('hidden');
                    desktopAuth.classList.add('flex');
                }
                
                // Paksa sembunyikan container burger
                if (burgerContainer) {
                    burgerContainer.classList.add('hidden');
                }

                // Tutup popup jika terbuka
                if (mobilePopup && !mobilePopup.classList.contains('hidden')) {
                    mobilePopup.classList.add('hidden');
                    document.getElementById('burgerIcon')?.classList.remove('hidden');
                    document.getElementById('closeIcon')?.classList.add('hidden');
                }

            } else {
                // Mode Mobile: Sembunyikan Menu Desktop, Tampilkan Burger
                
                const desktopMenu = document.getElementById('desktopMenu');
                const desktopAuth = document.getElementById('desktopAuth');
                const burgerContainer = document.getElementById('burgerContainer');

                if (desktopMenu) {
                    desktopMenu.classList.add('hidden');
                    desktopMenu.classList.remove('flex');
                }
                if (desktopAuth) {
                    desktopAuth.classList.add('hidden');
                    desktopAuth.classList.remove('flex');
                }
                if (burgerContainer) {
                    burgerContainer.classList.remove('hidden');
                }
            }
        }

        // Jalankan saat load awal & saat resize
        document.addEventListener('DOMContentLoaded', checkScreenSize);
        window.addEventListener('resize', checkScreenSize);


        // --- 2. TOGGLE DROPDOWNS ---
        function toggleProfileMenu() {
            const dropdown = document.getElementById('profileDropdown');
            const chevron = document.getElementById('chevronIcon');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                setTimeout(() => dropdown.classList.remove('opacity-0', 'scale-95'), 10);
                chevron.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => dropdown.classList.add('hidden'), 200);
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenuPopup');
            const burger = document.getElementById('burgerIcon');
            const close = document.getElementById('closeIcon');

            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                burger.classList.add('hidden');
                close.classList.remove('hidden');
                menu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => menu.classList.remove('opacity-0', 'scale-95'), 10);
            } else {
                burger.classList.remove('hidden');
                close.classList.add('hidden');
                menu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => menu.classList.add('hidden'), 200);
            }
        }

        // Close dropdowns on click outside
        document.addEventListener('click', function(event) {
            const profileContainer = document.getElementById('profileMenuContainer');
            const profileDropdown = document.getElementById('profileDropdown');
            if (profileContainer && !profileContainer.contains(event.target) && profileDropdown && !profileDropdown.classList.contains('hidden')) {
                profileDropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => profileDropdown.classList.add('hidden'), 200);
                document.getElementById('chevronIcon').style.transform = 'rotate(0deg)';
            }

            const mobileContainer = document.getElementById('burgerContainer');
            const mobileMenu = document.getElementById('mobileMenuPopup');
            // Hanya jalankan jika mobile container ada (artinya sedang di mode mobile)
            if (mobileContainer && !mobileContainer.classList.contains('hidden') && !mobileContainer.contains(event.target) && mobileMenu && !mobileMenu.classList.contains('hidden')) {
                toggleMobileMenu();
            }
        });

        const globalAuthModal = document.getElementById('globalAuthModal');
        function openGlobalAuthModal() { if(globalAuthModal) globalAuthModal.classList.remove('hidden'); }
        function closeGlobalAuthModal() { if(globalAuthModal) globalAuthModal.classList.add('hidden'); }
    </script>
    @stack('scripts')
</body>
</html>