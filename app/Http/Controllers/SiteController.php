<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function showHome()
    {
        if (Auth::check()) {
            if (Auth::user()->is_vet) {
                return redirect()->route('vet.dashboard');
            } else {
                return redirect()->route('client.dashboard');
            }
        }

        return view('index');
    }

    public function showClientDashboard()
    {
        $user = Auth::user();
        $patients = $user->patients()->get();
        $appointments = $user->appointments()->with('patient')->orderBy('appointment_date', 'desc')->get();

        return view('client', [
            'patients' => $patients,
            'appointments' => $appointments
        ]);
    }

    public function showVetDashboard()
    {
        if (!Auth::user()->is_vet) {
            return redirect()->route('client.dashboard');
        }

        $appointments = Appointment::with(['patient', 'user'])->orderBy('appointment_date', 'desc')->get();
            
        return view('vet', ['appointments' => $appointments]);
    }
}
