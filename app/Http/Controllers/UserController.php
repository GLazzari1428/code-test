<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function storePatient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('patients', 'public');
        }

        Auth::user()->patients()->create([
            'name' => $request->name,
            'species' => $request->species,
            'breed' => $request->breed,
            'photo' => $path,
        ]);

        return back();
    }

    public function editPatient(Patient $patient)
    {
        $this->authorize('update', $patient);
        return view('edit-patient', ['patient' => $patient]);
    }
    
    public function updatePatient(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);
    
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
        ]);
    
        $patient->update($data);
    
        return redirect()->route('client.dashboard');
    }

    public function deletePatient(Patient $patient)
    {
        $this->authorize('delete', $patient);
        $patient->delete();
        return back();
    }
}
