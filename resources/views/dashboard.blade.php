<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-green-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-brand-green to-emerald-800 overflow-hidden shadow-2xl sm:rounded-2xl mb-8">
                <div class="p-8 text-white flex justify-between items-center">
                    <div>
                        <h3 class="text-3xl font-bold">Welcome, {{ Auth::user()->name }}</h3>
                        <p class="text-white opacity-90 mt-2 text-lg">NRB Global Convention 2025 Participant Portal</p>
                    </div>
                    <img src="{{ asset('images/logo.png') }}" class="h-20 w-auto drop-shadow-2xl hidden md:block">
                </div>
            </div>

            <!-- Status Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Registration Status -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl md:col-span-2 border border-slate-100">
                    <div class="p-8">
                        <h4 class="text-2xl font-bold text-slate-800 mb-6">Registration Status</h4>
                        
                        @if($registration)
                            <div class="flex items-center justify-between p-6 bg-gradient-to-r from-slate-50 to-green-50 rounded-xl border border-slate-200 shadow-sm">
                                <div>
                                    <p class="text-sm text-slate-500 uppercase tracking-wider font-semibold mb-2">Current Status</p>
                                    <div class="mt-1">
                                        @if($registration->status === 'approved')
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-bold bg-gradient-to-r from-green-400 to-emerald-500 text-white shadow-lg">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                Approved
                                            </span>
                                        @elseif($registration->status === 'rejected')
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-bold bg-gradient-to-r from-red-400 to-red-500 text-white shadow-lg">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                                Rejected
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-bold bg-gradient-to-r from-amber-400 to-yellow-500 text-white shadow-lg">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                                                Pending Review
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-slate-500">Submitted on</p>
                                    <p class="font-bold text-slate-900 text-lg">{{ $registration->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>

                            @if($registration->status === 'approved')
                                <div class="mt-6">
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-6 shadow-sm">
                                        <h5 class="text-emerald-700 font-bold flex items-center text-lg">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            You are all set!
                                        </h5>
                                        <p class="text-slate-700 mt-3">Your registration has been approved. You should have received your digital visiting card via email. Please check your inbox.</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            @if(auth()->user()->hasRole(['admin', 'super_admin']))
                                {{-- Admin users see link to admin panel instead --}}
                                <div class="text-center py-16 bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl border-2 border-dashed border-blue-300 shadow-inner">
                                    <div class="bg-gradient-to-r from-blue-100 to-purple-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6 shadow-lg">
                                        <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 mb-2">Admin Account</h3>
                                    <p class="text-slate-600 mb-8">Use the admin panel to manage registrations and users.</p>
                                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Go to Admin Panel
                                    </a>
                                </div>
                            @else
                                {{-- Regular users see registration button --}}
                                <div class="text-center py-16 bg-gradient-to-br from-slate-50 to-green-50 rounded-2xl border-2 border-dashed border-slate-300 shadow-inner">
                                    <div class="bg-gradient-to-r from-emerald-100 to-green-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6 shadow-lg">
                                        <svg class="h-10 w-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900 mb-2">No registration found</h3>
                                    <p class="text-slate-600 mb-8">Get started by submitting your application.</p>
                                    <a href="{{ route('registration.create') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        Start Registration
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Event Details Card -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-slate-100">
                    <div class="p-8">
                        <h4 class="text-2xl font-bold text-slate-800 mb-6">Event Details</h4>
                        <ul class="space-y-6">
                            <li class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-100 to-brand-red rounded-xl flex items-center justify-center mr-4 shadow-md group-hover:shadow-lg transition-shadow">
                                    <svg class="w-6 h-6 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">Date</p>
                                    <p class="text-slate-600 mt-1">October 15-17, 2025</p>
                                </div>
                            </li>
                            <li class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-100 to-brand-red rounded-xl flex items-center justify-center mr-4 shadow-md group-hover:shadow-lg transition-shadow">
                                    <svg class="w-6 h-6 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">Location</p>
                                    <p class="text-slate-600 mt-1">Javits Center, New York</p>
                                </div>
                            </li>
                            <li class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-100 to-brand-red rounded-xl flex items-center justify-center mr-4 shadow-md group-hover:shadow-lg transition-shadow">
                                    <svg class="w-6 h-6 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">Support</p>
                                    <a href="mailto:support@nrbworld.com" class="text-emerald-600 hover:text-emerald-700 transition-colors mt-1 inline-block font-medium">support@nrbworld.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
