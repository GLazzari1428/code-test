<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function client()
    {
        return view('client')->with('patients', auth()->User()->patients);
    }

    public function vet()
    {
        return view('vet')->with('patients', Patient::all());
    }

    // -- NOVAS FUNCIONALIDADES --

    // CONSULTAS
    public function createAppointment()
    {
        return view('create-appointment');
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'hour' => 'required',
        ]);

        $patient = new Patient($request->all());
        $patient->user_id = Auth::id();
        $patient->save();

        return redirect()->route('client')->with('toast', 'Consulta agendada com sucesso!');
    }

    public function editAppointment($id)
    {
        $appointment = Patient::findOrFail($id);
        $this->authorize('update', $appointment); // Usa a PatientPolicy
        return view('edit-appointment')->with('appointment', $appointment);
    }

    public function updateAppointment(Request $request, $id)
    {
        $appointment = Patient::findOrFail($id);
        $this->authorize('update', $appointment); // Usa a PatientPolicy

        $request->validate([
            'description' => 'required|string',
            'date' => 'required|date',
            'hour' => 'required',
        ]);

        $appointment->update($request->only(['description', 'date', 'hour']));
        
        $route = auth()->User()->type === 'VET' ? 'vet' : 'client';
        return redirect()->route($route)->with('toast', 'Consulta atualizada com sucesso!');
    }

    public function destroyAppointment($id)
    {
        $appointment = Patient::findOrFail($id);
        $this->authorize('delete', $appointment); // Usa a PatientPolicy

        $appointment->delete();

        return back()->with('toast', 'Consulta excluída com sucesso!');
    }

    // PACIENTES
    public function editPatient($id)
    {
        $patient = Patient::findOrFail($id);
        $this->authorize('update', $patient); // Usa a PatientPolicy
        return view('edit-patient')->with('patient', $patient);
    }

    public function updatePatient(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $this->authorize('update', $patient); // Usa a PatientPolicy

        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
        ]);

        $patient->update($request->only(['name', 'species']));

        $route = auth()->User()->type === 'VET' ? 'vet' : 'client';
        return redirect()->route($route)->with('toast', 'Paciente atualizado com sucesso!');
    }
}
