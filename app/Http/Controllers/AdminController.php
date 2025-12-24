<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $pending = Registration::where('status', 'pending')->latest()->get();
        $approved = Registration::where('status', 'approved')->latest()->get();
        $rejected = Registration::where('status', 'rejected')->latest()->get();
        
        return view('admin.dashboard', compact('pending', 'approved', 'rejected'));
    }

    public function approve(Registration $registration)
    {
        $registration->update(['status' => 'approved']);
        
        \Illuminate\Support\Facades\Mail::to($registration->email)->send(new \App\Mail\ApprovalNotification($registration));
        
        return redirect()->route('admin.dashboard')->with('status', 'Registration approved successfully.');
    }

    public function reject(Registration $registration)
    {
        $registration->update(['status' => 'rejected']);
        return redirect()->route('admin.dashboard')->with('status', 'Registration rejected.');
    }

    public function downloadPdf(Registration $registration)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.visiting-card', compact('registration'));
        return $pdf->download('visiting-card-' . $registration->id . '.pdf');
    }
}
