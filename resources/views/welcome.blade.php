<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NRB Global Convention 2025</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gradient-to-br from-slate-50 via-white to-green-50 text-slate-900 font-sans">
        
        <!-- Navigation -->
        <nav class="bg-gradient-to-r from-brand-green to-emerald-800 shadow-2xl sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <div class="flex-shrink-0 transform transition hover:scale-105">
                        <img src="{{ asset('images/logo.png') }}" alt="NRB World Logo" class="h-16 w-auto drop-shadow-lg">
                    </div>
                    <div class="hidden md:block">
                        @if (Route::has('login'))
                            <div class="flex gap-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold leading-6 text-white hover:text-slate-100 transition-all duration-300">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-semibold text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition-all duration-300">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="rounded-lg bg-white px-6 py-2.5 text-sm font-bold text-emerald-600 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform transition-all duration-300">Register Now</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative isolate px-6 lg:px-8">
            <!-- Gradient Background Blobs -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-emerald-400 to-green-600 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
            
            <div class="mx-auto max-w-4xl py-24 sm:py-32 lg:py-40 text-center">
                <!-- Badge -->
                <div class="hidden sm:mb-10 sm:flex sm:justify-center animate-fade-in">
                    <div class="relative rounded-full px-4 py-2 text-sm leading-6 text-slate-700 bg-white shadow-lg border border-emerald-100 hover:border-emerald-300 transition-all duration-300">
                        <span class="inline-flex items-center gap-2">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            Registration is now open for 2025
                        </span>
                        <a href="{{ route('register') }}" class="font-semibold text-emerald-600 ml-2">
                            <span class="absolute inset-0" aria-hidden="true"></span>Join now <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Headline -->
                <h1 class="text-5xl font-extrabold tracking-tight text-slate-900 sm:text-7xl leading-tight">
                    NRB Global Convention 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-brand-red">2025</span>
                </h1>
                
                <p class="mt-8 text-xl leading-8 text-slate-600 max-w-2xl mx-auto font-medium">
                    Join global leaders, innovators, and changemakers at the Javits Center, New York. Connect, collaborate, and shape the future together.
                </p>

                <!-- CTA Buttons -->
                <div class="mt-12 flex items-center justify-center gap-6">
                    <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transform transition-all duration-300 overflow-hidden">
                        <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-white rounded-full group-hover:w-full group-hover:h-56 opacity-10"></span>
                        <span class="relative">Get Started</span>
                        <svg class="relative ml-2 -mr-1 w-5 h-5 transition-transform group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#about" class="inline-flex items-center px-8 py-4 text-lg font-semibold text-slate-700 bg-white rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform transition-all duration-300 border border-slate-200">
                        Learn more
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Stats/Features -->
                <div class="mt-20 grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-slate-100">
                        <div class="text-4xl font-bold text-emerald-600">500+</div>
                        <div class="mt-2 text-sm font-medium text-slate-600">Global Leaders</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-slate-100">
                        <div class="text-4xl font-bold text-emerald-600">3 Days</div>
                        <div class="mt-2 text-sm font-medium text-slate-600">Of Innovation</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-slate-100">
                        <div class="text-4xl font-bold text-emerald-600">50+</div>
                        <div class="mt-2 text-sm font-medium text-slate-600">Countries</div>
                    </div>
                </div>
            </div>

            <!-- Bottom Gradient Blob -->
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-brand-red to-emerald-500 opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 mt-20">
            <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
                <div class="flex justify-center space-x-6 md:order-2">
                    <a href="#" class="text-slate-400 hover:text-emerald-600 transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-emerald-600 transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                    </a>
                </div>
                <div class="mt-8 md:order-1 md:mt-0">
                    <p class="text-center text-sm leading-5 text-slate-500">&copy; 2025 NRB World. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
