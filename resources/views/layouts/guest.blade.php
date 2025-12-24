<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-brand-green-mint">
        <div class="min-h-screen flex flex-col justify-center items-center px-6 py-12">
            <!-- Logo -->
            <div class="mb-8">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="NRB World Logo" class="h-16 w-auto mx-auto">
                </a>
            </div>

            <!-- Content Card -->
            <div class="w-full sm:max-w-md">
                <div class="bg-white shadow-lg overflow-hidden sm:rounded-xl border border-slate-200">
                    <div class="px-8 py-10">
                        {{ $slot }}
                    </div>
                </div>
                
                <!-- Back Link -->
                <div class="mt-6 text-center">
                    <a href="/" class="text-sm text-slate-600 hover:text-brand-green transition-colors inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to home
                    </a>
                </div>
                
                <!-- Developer Credit -->
                <div class="mt-8 text-center">
                    <p class="text-xs text-slate-500">
                        Developed by <a href="https://codepromax.com.de/" target="_blank" class="text-brand-green hover:text-emerald-700 font-medium transition-colors">CodeProMax Tech</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
