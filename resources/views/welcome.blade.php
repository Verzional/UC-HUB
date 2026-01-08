<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UC HUB - Great Career Opportunities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .gradient-bg {
            background: radial-gradient(circle at 80% 20%, #fff3e0 0%, #ffffff 50%);
        }

        .hero-circle {
            background: linear-gradient(135deg, #ff9800 0%, #ffcc80 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="bg-white text-gray-900 overflow-x-hidden">

    <nav class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md
           border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            </div>

            <a href="{{ route('login') }}"
                class="bg-orange-500 text-white px-5 py-2 rounded-full text-sm font-semibold
                  shadow hover:bg-orange-600 transition">
                Sign In
            </a>
        </div>
    </nav>

    <section
        class="max-w-7xl mx-auto px-6 pt-48 lg:pt-52 pb-24 grid lg:grid-cols-2 gap-12 items-center relative gradient-bg">
        <div class="z-10">
            <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight mb-4">
                Ignite Your Future
            </h1>
            <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight mb-4">
                with <span class="text-orange-500 italic">Great Career</span>
            </h1>
            <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight mb-8">
                Opportunities
            </h1>
            <p class="text-lg text-gray-600 max-w-lg leading-relaxed mb-8">
                An integrated platform that connects Ciputra University talents with trusted industry partners.
            </p>
        </div>

        <div class="relative flex justify-center items-end w-full max-w-xl lg:max-w-2xl mx-auto">
            <div
                class="hero-circle absolute -z-10 opacity-20 blur-3xl
           w-64 h-64 sm:w-72 sm:h-72 md:w-80 md:h-80 lg:w-96 lg:h-96 -translate-y-6">
            </div>

            <div
                class="hero-circle rounded-full
           w-52 h-52 sm:w-64 sm:h-64 md:w-72 md:h-72 lg:w-80 lg:h-80 -translate-y-4">
            </div>

            <img src="{{ asset('images/welcome.png') }}" alt="welcome"
                class="absolute bottom-0 w-64 sm:w-80 md:w-[420px] lg:w-[520px] xl:w-[580px] transform translate-y-20">

            <div
                class="absolute top-20 left-0 sm:-left-8
               glass-card p-3 rounded-xl shadow-xl
               flex items-center gap-2
               animate-bounce">
                <div class="bg-orange-100 p-2 rounded-lg text-orange-600">📅</div>
                <span class="text-xs font-bold whitespace-nowrap">Interview Scheduled</span>
            </div>

            <div
                class="absolute top-0 right-20 sm:right-24
         glass-card p-3 rounded-xl shadow-xl text-center animate-bounce">
                <span class="text-[10px] uppercase text-gray-400 font-bold block">
                    Skill Match
                </span>
                <span class="text-lg font-black text-orange-500">98%</span>
            </div>
        </div>


    </section>

    <div class="bg-white py-12 border-y border-gray-50 overflow-hidden">
        <p class="text-center text-xs font-bold text-gray-400 uppercase tracking-widest mb-8">
            Our Top Company Partners
        </p>

        <style>
            @keyframes scroll {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-50%);
                }
            }

            .animate-scroll {
                display: flex;
                width: max-content;
                animation: scroll 30s linear infinite;
            }
        </style>

        <div
            class="relative flex items-center overflow-hidden before:absolute before:left-0 before:top-0 before:z-10 before:h-full before:w-20 before:bg-gradient-to-r before:from-white before:to-transparent after:absolute after:right-0 after:top-0 after:z-10 after:h-full after:w-20 after:bg-gradient-to-l after:after:from-white after:to-transparent">

            <div class="animate-scroll flex items-center gap-8 lg:gap-16">
                <img src="{{ asset('images/partners/avian.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/artaboga.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/bpi.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/garuda.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/hsbc.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/papaya.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/polygon.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/sanf.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/spil.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/viva.png') }}" class="h-16 object-contain" alt="Partner">

                <img src="{{ asset('images/partners/avian.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/artaboga.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/bpi.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/garuda.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/hsbc.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/papaya.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/polygon.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/sanf.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/spil.png') }}" class="h-16 object-contain" alt="Partner">
                <img src="{{ asset('images/partners/viva.png') }}" class="h-16 object-contain" alt="Partner">
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-6 py-24 text-center">
        <h2 class="text-4xl font-extrabold mb-16">What You Can Do with <span class="text-orange-500">UC HUB</span></h2>

        <div class="grid md:grid-cols-3 gap-8">
            <div
                class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <img src="{{ asset('images/2.png') }}" alt="welcome">
                <h3 class="font-bold text-lg mb-4">Discover the Right Opportunities</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Explore verified internship and job openings from
                    Universitas Ciputra partner companies, aligned with your profile and career interests.</p>
            </div>
            <div
                class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <img src="{{ asset('images/3.png') }}" alt="welcome">

                <h3 class="font-bold text-lg mb-4">Get Smart & Personalized Recommendations</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Receive AI-powered job recommendations based on your
                    skills, interests, and career readiness - no more random searching.</p>
            </div>
            <div
                class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <img src="{{ asset('images/4.png') }}" alt="welcome">

                <h3 class="font-bold text-lg mb-4">Get Recommended & Connected</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Get recommended by ICE to companies looking for your
                    talent and connect with UC alumni working in partner companies.</p>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-20">
        <div class="bg-white rounded-[50px] border border-orange-100 p-12 text-center shadow-2xl shadow-orange-100/50">
            <h2 class="text-4xl font-extrabold mb-8">About Us</h2>
            <p class="text-gray-600 leading-relaxed max-w-4xl mx-auto mb-10">
                <span class="text-orange-500 font-bold italic">ICE (Internship, Certification, and
                    Employability)</span>
                is Universitas Ciputra's dedicated career development unit focused on helping students and graduates
                successfully transition into the professional world. As part of the Career and Alumni Development
                services at UC Career Center, ICE connects students with industry opportunities, provides data-driven
                employability support, and strengthens relationships between UC, partner companies, and alumni.
            </p>
            <div class="aspect-video max-w-3xl mx-auto rounded-3xl overflow-hidden bg-gray-200 relative shadow-2xl">
                <iframe class="w-full h-full" src="https://www.youtube.com/embed/d8o_w9n36I0"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <footer class="bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 text-gray-600">

                <div class="md:col-span-4">
                    <div class="flex items-center gap-2 mb-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
                    </div>
                    <p class="text-sm leading-relaxed max-w-xs text-gray-500">
                        Job & internship platform for Universitas Ciputra students.
                    </p>
                </div>

                <div class="md:col-span-4">
                    <h4 class="font-bold text-gray-900 mb-6 uppercase tracking-wider text-xs">Contact Us</h4>
                    <div class="flex flex-col space-y-4">
                        <a href="mailto:ice@ciputra.ac.id"
                            class="group flex items-center gap-3 text-sm hover:text-orange-600 transition-colors duration-200">
                            <div class="p-2 bg-white rounded-lg shadow-sm group-hover:bg-orange-50 transition-colors">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-orange-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            ice@ciputra.ac.id
                        </a>
                        <a href="https://wa.me/6285860375741"
                            class="group flex items-center gap-3 text-sm hover:text-orange-600 transition-colors duration-200">
                            <div
                                class="p-2 bg-white rounded-lg shadow-sm group-hover:bg-orange-50 transition-colors text-gray-400 group-hover:text-orange-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.41 0 .01 5.399.007 12.039c0 2.12.543 4.19 1.57 6.076L0 24l6.05-1.587a11.83 11.83 0 005.996 1.621h.005c6.64 0 12.04-5.4 12.043-12.041a11.768 11.768 0 00-3.541-8.508z">
                                    </path>
                                </svg>
                            </div>
                            085860375741
                        </a>
                    </div>
                </div>

                <div class="md:col-span-4">
                    <h4 class="font-bold text-gray-900 mb-6 uppercase tracking-wider text-xs">Office Location</h4>
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm mt-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm leading-relaxed text-gray-500">
                            CitraLand CBD Boulevard, Made,<br>
                            Kec. Sambikerep, Surabaya, Jawa Timur,<br>
                            Indonesia, 60219
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-16 pt-8 border-t border-gray-200 flex justify-center items-center">
                <p class="text-xs text-gray-400 font-medium text-center">
                    © 2025 UC HUB — ICE Universitas Ciputra. All rights reserved.
                </p>
            </div>

        </div>
    </footer>

</body>

</html>
