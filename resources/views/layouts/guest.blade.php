<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top left, #fff3e0 0%, #ffffff 40%);
            background-color: #ffffff;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-12 px-4">
        <div class="w-full max-w-[650px] mb-4">
            <a href="/" class="flex items-center text-gray-500 hover:text-gray-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-semibold text-sm">Back to Main Page</span>
            </a>
        </div>

        <div class="w-full max-w-[650px] bg-white p-8 sm:p-12 shadow-[0px_20px_50px_rgba(255,145,0,0.1)] border border-orange-200 rounded-[40px] mb-12">
            {{ $slot }}
        </div>
    </div>
</body>
</html>