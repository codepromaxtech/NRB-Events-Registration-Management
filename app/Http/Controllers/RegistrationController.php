<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function create()
    {
        // Redirect admin/super_admin users to admin panel instead
        if (auth()->user()->hasRole(['admin', 'super_admin'])) {
            return redirect()->route('admin.dashboard')
                ->with('status', 'Admins cannot submit registrations. Please use the admin panel to manage user registrations.');
        }

        // Check if user already has a registration
        $existingRegistration = Registration::where('user_id', Auth::id())->first();
        if ($existingRegistration) {
            return redirect()->route('dashboard')->with('status', 'You have already submitted a registration request.');
        }

        return view('registration.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
            'passport_number' => 'required|string|max:50',
            'nationality' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'gender' => 'required|string|in:male,female,other',
            'phone' => 'required|string|max:20',
            'organization' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'type_of_business' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'business_description' => 'nullable|string',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'signature' => 'required|file|mimes:jpg,jpeg,png|max:1024',
        ]);

        $photoPath = $request->file('photo')->store('photos', 'public');
        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        $signaturePath = $request->file('signature')->store('signatures', 'public');

        Registration::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => $request->phone,
            'photo_path' => $photoPath,
            'passport_number' => $request->passport_number,
            'nationality' => $request->nationality,
            'country' => $request->country,
            'gender' => $request->gender,
            'organization' => $request->organization,
            'type_of_business' => $request->type_of_business,
            'designation' => $request->designation,
            'website' => $request->website,
            'business_description' => $request->business_description,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'payment_proof_path' => $paymentProofPath,
            'signature_path' => $signaturePath,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('status', 'Registration submitted successfully! Please wait for admin approval.');
    }
}
