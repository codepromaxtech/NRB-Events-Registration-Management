<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-green-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            @if (session('status'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Users Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200">
                <div class="p-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-slate-800">All Users</h3>
                        <div class="text-sm text-slate-500">
                            Total: <span class="font-semibold text-slate-900">{{ $users->count() }}</span> users
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-gradient-to-r from-slate-50 to-green-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Registration</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Joined</th>
                                    @if(auth()->user()->hasRole(['admin', 'super_admin']))
                                    <th class="px-6 py-3 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @forelse($users as $user)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-slate-900">{{ $user->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-slate-600">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if(auth()->user()->hasRole('super_admin') && $user->id !== auth()->id())
                                                <form action="{{ route('users.toggleRole', $user) }}" method="POST" class="inline">
                                                    @csrf
                                                    <select name="role" onchange="this.form.submit()" class="text-xs rounded-full px-3 py-1 font-semibold border-none focus:ring-2 focus:ring-brand-green
                                                        @if($user->hasRole('super_admin')) bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800
                                                        @elseif($user->hasRole('admin')) bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800
                                                        @else bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800
                                                        @endif">
                                                        <option value="register" {{ $user->hasRole('register') ? 'selected' : '' }}>User</option>
                                                        <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                                        <option value="super_admin" {{ $user->hasRole('super_admin') ? 'selected' : '' }}>Super Admin</option>
                                                    </select>
                                                </form>
                                            @else
                                                <span class="inline-flex text-xs rounded-full px-3 py-1 font-semibold
                                                    @if($user->hasRole('super_admin')) bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800
                                                    @elseif($user->hasRole('admin')) bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800
                                                    @else bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800
                                                    @endif">
                                                    @if($user->hasRole('super_admin')) Super Admin
                                                    @elseif($user->hasRole('admin')) Admin
                                                    @else User
                                                    @endif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($user->registration)
                                                <span class="inline-flex text-xs rounded-full px-3 py-1 font-semibold
                                                    @if($user->registration->status === 'approved') bg-gradient-to-r from-green-100 to-emerald-200 text-green-800
                                                    @elseif($user->registration->status === 'rejected') bg-gradient-to-r from-red-100 to-red-200 text-red-800
                                                    @else bg-gradient-to-r from-amber-100 to-yellow-200 text-amber-800
                                                    @endif">
                                                    {{ ucfirst($user->registration->status) }}
                                                </span>
                                            @else
                                                <span class="text-xs text-slate-400">No registration</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                        @if(auth()->user()->hasRole('super_admin'))
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if($user->id !== auth()->id())
                                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 font-semibold mr-4">Edit</a>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Delete</button>
                                                </form>
                                            @else
                                                <span class="text-slate-400 text-xs">Current User</span>
                                            @endif
                                        </td>
                                        @elseif(auth()->user()->hasRole('admin'))
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Edit</a>
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                </svg>
                                                <p class="text-lg font-medium">No users found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
