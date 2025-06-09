<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function create()
    {
        $patients = Auth::user()->patients;
        return view('create-appointment', ['patients' => $patients]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date_format:Y-m-d',
            'appointment_time' => 'required',
        ]);

        $patient = Patient::find($request->patient_id);
        if (Auth::id() !== $patient->user_id) {
            abort(403);
        }

        $dateTime = Carbon::createFromFormat('Y-m-d H:i', $request->appointment_date . ' ' . $request->appointment_time);

        Appointment::create([
            'patient_id' => $request->patient_id,
            'user_id' => Auth::id(),
            'appointment_date' => $dateTime,
            'status' => 'scheduled',
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Consulta agendada com sucesso!');
    }

    public function getAvailableSlots(Request $request)
    {
        $request->validate(['date' => 'required|date_format:Y-m-d']);
        $date = Carbon::parse($request->date);

        if ($date->isWeekend()) {
            return response()->json([]);
        }

        $startTime = $date->copy()->setHour(8);
        $endTime = $date->copy()->setHour(18);
        $availableSlots = [];

        $existingAppointments = Appointment::whereDate('appointment_date', $date->toDateString())
            ->get()
            ->map(function ($apt) {
                return Carbon::parse($apt->appointment_date)->format('H:i');
            })
            ->toArray();

        while ($startTime < $endTime) {
            $currentTimeSlot = $startTime->format('H:i');
            if (!in_array($currentTimeSlot, $existingAppointments)) {
                $availableSlots[] = $currentTimeSlot;
            }
            $startTime->addHour();
        }

        return response()->json($availableSlots);
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        return view('appointment', ['appointment' => $appointment]);
    }

    public function edit(Appointment $appointment)
    {
        if (!Auth::user()->is_vet) {
            abort(403);
        }
        return view('edit-appointment', ['appointment' => $appointment]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        if (!Auth::user()->is_vet) {
            abort(403);
        }

        $request->validate([
            'notes' => 'required|string',
        ]);

        $appointment->update([
            'notes' => $request->notes,
            'vet_id' => Auth::id(),
            'status' => 'finished',
        ]);

        return redirect()->route('vet.dashboard')->with('success', 'Consulta finalizada com sucesso!');
    }
}
