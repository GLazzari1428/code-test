<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class SiteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function client()
    {
        $user = Auth::user();
        $patients = Patient::where('user_id', $user->id)->get();
        return view('client', ['patients' => $patients]);
    }

    public function vet()
    {
        $patients = Patient::all();
        return view('vet', ['patients' => $patients]);
    }

    // Patient Methods
    public function editPatient($id)
    {
        $patient = Patient::findOrFail($id);
        $this->authorize('update', $patient);
        return view('edit-patient', ['patient' => $patient]);
    }

    public function updatePatient(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $this->authorize('update', $patient);

        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
        ]);
        
        $patient->update($request->only(['name', 'species']));

        return redirect()->route(Auth::user()->type == 'vet' ? 'vet' : 'client')->with('msg', 'Paciente atualizado com sucesso!');
    }


    // Appointment Methods
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

        $patient = new Patient();
        $patient->name = $request->name;
        $patient->species = $request->species;
        $patient->description = $request->description;
        $patient->date = $request->date;
        $patient->hour = $request->hour;
        $patient->user_id = Auth::user()->id;
        $patient->save();

        return redirect()->route('client')->with('msg', 'Consulta agendada com sucesso!');
    }

    public function editAppointment($id)
    {
        $appointment = Patient::findOrFail($id);
        $this->authorize('update', $appointment);
        return view('edit-appointment', ['appointment' => $appointment]);
    }

    public function updateAppointment(Request $request, $id)
    {
        $appointment = Patient::findOrFail($id);
        $this->authorize('update', $appointment);

        $request->validate([
            'description' => 'required|string',
            'date' => 'required|date',
            'hour' => 'required',
        ]);

        $appointment->update($request->only(['description', 'date', 'hour']));

        return redirect()->route(Auth::user()->type == 'vet' ? 'vet' : 'client')->with('msg', 'Consulta atualizada com sucesso!');
    }

    public function destroyAppointment($id)
    {
        $appointment = Patient::findOrFail($id);
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return back()->with('msg', 'Consulta excluída com sucesso!');
    }
}
