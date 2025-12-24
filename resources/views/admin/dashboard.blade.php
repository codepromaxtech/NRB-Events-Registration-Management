<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-slate-50 via-white to-green-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h3 class="text-3xl font-bold text-slate-900">Registration Management</h3>
                <p class="mt-2 text-slate-600">Review and manage convention registrations</p>
            </div>

            <!-- Tabs -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2 border-b border-slate-200">
                    <button onclick="showTab('pending')" id="tab-pending" class="tab-button px-6 py-3 font-semibold border-b-2 border-brand-green text-brand-green">
                        Pending ({{ $pending->count() }})
                    </button>
                    <button onclick="showTab('approved')" id="tab-approved" class="tab-button px-6 py-3 font-semibold border-b-2 border-transparent text-slate-600 hover:text-brand-green">
                        Approved ({{ $approved->count() }})
                    </button>
                    <button onclick="showTab('rejected')" id="tab-rejected" class="tab-button px-6 py-3 font-semibold border-b-2 border-transparent text-slate-600 hover:text-brand-green">
                        Rejected ({{ $rejected->count() }})
                    </button>
                </div>
            </div>

            <!-- Pending Tab -->
            <div id="content-pending" class="tab-content">
                @if($pending->isEmpty())
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
                        <div class="text-slate-400 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-700 mb-2">No Pending Registrations</h4>
                        <p class="text-slate-500">All registrations have been processed</p>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider hidden md:table-cell">Country</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider hidden lg:table-cell">Business</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Payment</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100">
                                    @foreach($pending as $registration)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-semibold text-slate-900">{{ $registration->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm">{{ $registration->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm hidden md:table-cell">{{ $registration->country }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm hidden lg:table-cell">{{ Str::title(str_replace('_', ' ', $registration->type_of_business)) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($registration->payment_proof_path)
                                                    <a href="{{ asset('storage/' . $registration->payment_proof_path) }}" target="_blank" class="inline-flex items-center text-sm font-medium text-brand-green hover:text-emerald-700">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                        View
                                                    </a>
                                                @else
                                                    <span class="text-slate-400 text-sm">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <form action="{{ route('admin.approve', $registration) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.reject', $registration) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Approved Tab -->
            <div id="content-approved" class="tab-content hidden">
                @if($approved->isEmpty())
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
                        <div class="text-green-400 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-700 mb-2">No Approved Registrations</h4>
                        <p class="text-slate-500">Approved registrations will appear here</p>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead class="bg-green-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider hidden md:table-cell">Country</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider hidden lg:table-cell">Approved On</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100">
                                    @foreach($approved as $registration)
                                        <tr class="hover:bg-green-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-semibold text-slate-900">{{ $registration->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm">{{ $registration->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm hidden md:table-cell">{{ $registration->country }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm hidden lg:table-cell">{{ $registration->updated_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('admin.downloadPdf', $registration) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-md shadow-sm transition-colors">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                        PDF
                                                    </a>
                                                    <form action="{{ route('admin.destroy', $registration) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this registration?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-md shadow-sm transition-colors">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Rejected Tab -->
            <div id="content-rejected" class="tab-content hidden">
                @if($rejected->isEmpty())
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
                        <div class="text-red-400 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-700 mb-2">No Rejected Registrations</h4>
                        <p class="text-slate-500">Rejected registrations will appear here</p>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead class="bg-red-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider hidden md:table-cell">Country</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider hidden lg:table-cell">Rejected On</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100">
                                    @foreach($rejected as $registration)
                                        <tr class="hover:bg-red-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-semibold text-slate-900">{{ $registration->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm">{{ $registration->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm hidden md:table-cell">{{ $registration->country }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm hidden lg:table-cell">{{ $registration->updated_at->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(el => {
                el.classList.remove('border-brand-green', 'text-brand-green');
                el.classList.add('border-transparent', 'text-slate-600');
            });
            
            // Show selected tab
            document.getElementById('content-' + tab).classList.remove('hidden');
            document.getElementById('tab-' + tab).classList.remove('border-transparent', 'text-slate-600');
            document.getElementById('tab-' + tab).classList.add('border-brand-green', 'text-brand-green');
        }
    </script>
</x-app-layout>
