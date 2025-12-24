<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-green-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200">
                <div class="p-6 sm:p-8">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-slate-800">Edit User Information</h3>
                        <p class="text-sm text-slate-600 mt-1">Update user account details</p>
                    </div>

                    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="email" name="email" :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Current Role (Display Only) -->
                        <div>
                            <x-input-label for="role" :value="__('Current Role')" />
                            <div class="mt-1 px-4 py-2 bg-slate-50 border border-slate-200 rounded-md">
                                <span class="text-sm font-medium text-slate-700">
                                    @if($user->hasRole('super_admin'))
                                        Super Admin
                                    @elseif($user->hasRole('admin'))
                                        Admin
                                    @else
                                        User
                                    @endif
                                </span>
                                <p class="text-xs text-slate-500 mt-1">Role can be changed from the user list page</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-200">
                            <a href="{{ route('users.index') }}" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-brand-green to-emerald-600 hover:from-brand-green hover:to-emerald-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
