<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Registration - {{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-brand-green-mint">
        
        <!-- Hero Header -->
        <div class="bg-gradient-to-r from-brand-green to-emerald-800 py-8 sm:py-12 shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
                <img src="{{ asset('images/logo.png') }}" alt="NRB World Logo" class="h-16 sm:h-20 md:h-24 w-auto mx-auto mb-4 sm:mb-6 drop-shadow-2xl">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white">Registration Form</h1>
                <p class="mt-2 sm:mt-3 text-base sm:text-lg md:text-xl text-white opacity-90">NRB Global Convention 2025</p>
                <div class="mt-4 sm:mt-6 inline-flex items-center gap-2 bg-white bg-opacity-20 rounded-full px-3 sm:px-4 py-2 text-xs sm:text-sm text-white">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="hidden sm:inline">Application Deadline: September 30, 2025</span>
                    <span class="sm:hidden">Deadline: Sep 30, 2025</span>
                </div>
            </div>
        </div>
        
        <!-- Form Content -->
        <div class="py-6 sm:py-8 md:py-12 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:shadow-2xl rounded-xl sm:rounded-2xl border border-slate-200">
                    <div class="p-4 sm:p-6 md:p-8 lg:p-10">
                        <form method="POST" action="{{ route('registration.store') }}" enctype="multipart/form-data" class="space-y-8">
                            @csrf

                            <!-- 1. Personal Information -->
                            <div>
                                <h3 class="text-lg sm:text-xl font-semibold text-slate-900 border-b pb-3 mb-6 flex items-center">
                                    <span class="bg-brand-green text-white rounded-full w-8 h-8 flex items-center justify-center text-sm mr-3 flex-shrink-0">1</span>
                                    Personal Information
                                </h3>
                                
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Photo Upload -->
                                    <div class="col-span-1 lg:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Photo</label>
                                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                            <div class="shrink-0">
                                                <div class="h-20 w-20 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 w-full">
                                                <label class="block w-full">
                                                    <span class="sr-only">Choose profile photo</span>
                                                    <input type="file" name="photo" class="block w-full text-sm text-slate-600
                                                        file:mr-4 file:py-2.5 file:px-5
                                                        file:rounded-lg file:border-0
                                                        file:text-sm file:font-semibold
                                                        file:bg-brand-green file:text-white
                                                        file:cursor-pointer
                                                        hover:file:bg-emerald-700
                                                        focus:outline-none
                                                    " required />
                                                </label>
                                                <p class="mt-2 text-xs text-slate-500">PNG, JPG up to 2MB</p>
                                            </div>
                                        </div>
                                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                    </div>

                                    <!-- Passport / NID -->
                                    <div>
                                        <x-input-label for="passport_number" :value="__('Passport / NID Number')" />
                                        <x-text-input id="passport_number" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="passport_number" :value="old('passport_number')" required />
                                        <x-input-error :messages="$errors->get('passport_number')" class="mt-2" />
                                    </div>

                                    <!-- Nationality -->
                                    <div>
                                        <x-input-label for="nationality" :value="__('Nationality')" />
                                        <x-text-input id="nationality" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="nationality" :value="old('nationality')" required />
                                        <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                                    </div>

                                    <!-- Country of Residence -->
                                    <div>
                                        <x-input-label for="country" :value="__('Country of Residence')" />
                                        <x-text-input id="country" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="country" :value="old('country')" required />
                                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                    </div>

                                    <!-- Gender -->
                                    <div>
                                        <x-input-label for="gender" :value="__('Gender')" />
                                        <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-brand-green focus:ring-brand-green rounded-md shadow-sm" required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <x-input-label for="phone" :value="__('Phone Number')" />
                                        <x-text-input id="phone" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="tel" name="phone" :value="old('phone')" required />
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>

                                    <!-- Organization -->
                                    <div>
                                        <x-input-label for="organization" :value="__('Organization / Company')" />
                                        <x-text-input id="organization" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="organization" :value="old('organization')" required />
                                        <x-input-error :messages="$errors->get('organization')" class="mt-2" />
                                    </div>

                                    <!-- Designation -->
                                    <div>
                                        <x-input-label for="designation" :value="__('Job Title / Designation')" />
                                        <x-text-input id="designation" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="designation" :value="old('designation')" required />
                                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Professional Information -->
                            <div>
                                <h3 class="text-lg sm:text-xl font-semibold text-slate-900 border-b pb-3 mb-6 flex items-center">
                                    <span class="bg-brand-green text-white rounded-full w-8 h-8 flex items-center justify-center text-sm mr-3 flex-shrink-0">2</span>
                                    Professional Information
                                </h3>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Type of Business -->
                                    <div class="col-span-1 lg:col-span-2">
                                        <x-input-label for="type_of_business" :value="__('Type of Business')" />
                                        <select id="type_of_business" name="type_of_business" class="block mt-1 w-full border-gray-300 focus:border-brand-green focus:ring-brand-green rounded-md shadow-sm" required>
                                            <option value="">Select Business Type</option>
                                            <option value="it" {{ old('type_of_business') == 'it' ? 'selected' : '' }}>IT / Technology</option>
                                            <option value="real_estate" {{ old('type_of_business') == 'real_estate' ? 'selected' : '' }}>Real Estate</option>
                                            <option value="healthcare" {{ old('type_of_business') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                                            <option value="education" {{ old('type_of_business') == 'education' ? 'selected' : '' }}>Education</option>
                                            <option value="finance" {{ old('type_of_business') ==  'finance' ? 'selected' : '' }}>Finance / Banking</option>
                                            <option value="manufacturing" {{ old('type_of_business') == 'manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                                            <option value="other" {{ old('type_of_business') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('type_of_business')" class="mt-2" />
                                    </div>

                                    <!-- Website -->
                                    <div>
                                        <x-input-label for="website" :value="__('Website (Optional)')" />
                                        <x-text-input id="website" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="url" name="website" :value="old('website')" placeholder="https://example.com" />
                                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                    </div>

                                    <!-- Business Description -->
                                    <div class="col-span-1 lg:col-span-2">
                                        <x-input-label for="business_description" :value="__('Business Description')" />
                                        <textarea id="business_description" name="business_description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-brand-green focus:ring-brand-green rounded-md shadow-sm">{{ old('business_description') }}</textarea>
                                        <x-input-error :messages="$errors->get('business_description')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Address -->
                            <div>
                                <h3 class="text-lg sm:text-xl font-semibold text-slate-900 border-b pb-3 mb-6 flex items-center">
                                    <span class="bg-brand-green text-white rounded-full w-8 h-8 flex items-center justify-center text-sm mr-3 flex-shrink-0">3</span>
                                    Address
                                </h3>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div class="col-span-1 lg:col-span-2">
                                        <x-input-label for="address_line1" :value="__('Address Line 1')" />
                                        <x-text-input id="address_line1" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="address_line1" :value="old('address_line1')" required />
                                        <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
                                    </div>

                                    <div class="col-span-1 lg:col-span-2">
                                        <x-input-label for="address_line2" :value="__('Address Line 2 (Optional)')" />
                                        <x-text-input id="address_line2" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="address_line2" :value="old('address_line2')" />
                                        <x-input-error :messages="$errors->get('address_line2')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="city" :value="__('City')" />
                                        <x-text-input id="city" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="city" :value="old('city')" required />
                                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="state" :value="__('State / Province')" />
                                        <x-text-input id="state" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="state" :value="old('state')" required />
                                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="zip_code" :value="__('Zip / Postal Code')" />
                                        <x-text-input id="zip_code" class="block mt-1 w-full focus:border-brand-green focus:ring-brand-green" type="text" name="zip_code" :value="old('zip_code')" required />
                                        <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- 4. Payment & Verification -->
                            <div>
                                <h3 class="text-lg sm:text-xl font-semibold text-slate-900 border-b pb-3 mb-6 flex items-center">
                                    <span class="bg-brand-green text-white rounded-full w-8 h-8 flex items-center justify-center text-sm mr-3 flex-shrink-0">4</span>
                                    Payment & Verification
                                </h3>

                                <div class="bg-gradient-to-br from-slate-50 to-green-50 p-6 sm:p-8 rounded-xl border-2 border-slate-200 mb-6">
                                    <h4 class="font-bold text-slate-900 text-xl mb-4">Registration Fee</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div class="bg-white p-5 rounded-lg shadow-sm border-l-4 border-brand-green">
                                            <p class="text-sm font-semibold text-slate-600 mb-1">For Bangladesh Residents</p>
                                            <p class="text-3xl font-bold text-brand-green">৳15,000 BDT</p>
                                        </div>
                                        <div class="bg-white p-5 rounded-lg shadow-sm border-l-4 border-brand-red">
                                            <p class="text-sm font-semibold text-slate-600 mb-1">For International Participants</p>
                                            <p class="text-3xl font-bold text-brand-red">$200 USD</p>
                                        </div>
                                    </div>

                                    <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                                        <h5 class="font-bold text-slate-900 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                            Bank Account Details
                                        </h5>
                                        
                                        <div class="space-y-4">
                                            <!-- BDT Account -->
                                            <div class="border-l-4 border-brand-green pl-4">
                                                <p class="text-xs font-semibold text-brand-green uppercase mb-2">For USD Payment ($200)</p>
                                                <div class="grid grid-cols-2 gap-3 text-sm">
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Bank Name:</span>
                                                        <p class="font-semibold text-slate-900">Islami Bank Bangladesh Ltd</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Branch:</span>
                                                        <p class="font-semibold text-slate-900">Gulshan Branch</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Account Name:</span>
                                                        <p class="font-semibold text-slate-900">NRB World</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Account Number:</span>
                                                        <p class="font-semibold text-slate-900 font-mono">20502510200123456</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Routing Number:</span>
                                                        <p class="font-semibold text-slate-900 font-mono">125260345</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border-t border-slate-200 pt-4"></div>

                                            <!-- USD Account -->
                                            <div class="border-l-4 border-brand-red pl-4">
                                                <p class="text-xs font-semibold text-brand-red uppercase mb-2">For BDT Payment (৳15,000) </p>
                                                <div class="grid grid-cols-2 gap-3 text-sm">
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Bank Name:</span>
                                                        <p class="font-semibold text-slate-900">Islami Bank Bangladesh Ltd</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Branch:</span>
                                                        <p class="font-semibold text-slate-900">Gulshan Branch</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Account Name:</span>
                                                        <p class="font-semibold text-slate-900">NRB World</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Account Number:</span>
                                                        <p class="font-semibold text-slate-900 font-mono">20502510200234567</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">SWIFT Code:</span>
                                                        <p class="font-semibold text-slate-900 font-mono">IBBLBDDH</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-slate-500 font-medium">Routing Number:</span>
                                                        <p class="font-semibold text-slate-900 font-mono">125260345</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                            <div class="text-sm text-amber-800">
                                                <p class="font-semibold mb-1">Important Payment Instructions:</p>
                                                <ul class="list-disc list-inside space-y-1 text-xs">
                                                    <li>Please upload your payment receipt after making the bank transfer</li>
                                                    <li>Ensure the payment amount matches your selected currency</li>
                                                    <li>Keep a copy of your transaction receipt for verification</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                                        <!-- Payment Proof -->
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Payment Receipt *</label>
                                            <input type="file" name="payment_proof" class="block w-full text-sm text-slate-600
                                                file:mr-4 file:py-2.5 file:px-5
                                                file:rounded-lg file:border-0
                                                file:text-sm file:font-semibold
                                                file:bg-slate-700 file:text-white
                                                file:cursor-pointer
                                                hover:file:bg-slate-800
                                                focus:outline-none
                                            " required />
                                            <p class="mt-2 text-xs text-slate-500">Upload payment receipt (PDF, JPG, PNG)</p>
                                            <x-input-error :messages="$errors->get('payment_proof')" class="mt-2" />
                                        </div>

                                        <!-- Digital Signature -->
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Digital Signature *</label>
                                            <input type="file" name="signature" class="block w-full text-sm text-slate-600
                                                file:mr-4 file:py-2.5 file:px-5
                                                file:rounded-lg file:border-0
                                                file:text-sm file:font-semibold
                                                file:bg-slate-700 file:text-white
                                                file:cursor-pointer
                                                hover:file:bg-slate-800
                                                focus:outline-none
                                            " required />
                                            <p class="mt-2 text-xs text-slate-500">Upload your signature image</p>
                                            <x-input-error :messages="$errors->get('signature')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="flex flex-col sm:flex-row items-center justify-between pt-6 border-t border-slate-200 gap-4">
                                <a href="{{ route('dashboard') }}" class="text-sm text-slate-600 hover:text-brand-green transition-colors inline-flex items-center gap-2 order-2 sm:order-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Back to Dashboard
                                </a>
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-brand-green border border-transparent rounded-lg font-bold text-white uppercase tracking-wider hover:bg-emerald-700 focus:bg-brand-green active:bg-brand-green focus:outline-none focus:ring-2 focus:ring-brand-green focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg order-1 sm:order-2">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="mt-8 text-center text-sm text-slate-600 pb-12">
                    <p>Application Deadline: <span class="font-semibold text-brand-red">September 30, 2025</span></p>
                    <p class="mt-2">Need help? Contact us at <a href="mailto:support@nrbworld.com" class="text-brand-green hover:underline font-medium">support@nrbworld.com</a></p>
                </div>
            </div>
        </div>
    </body>
</html>
