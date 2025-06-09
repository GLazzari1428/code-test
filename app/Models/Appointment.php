<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
        'vet_id',
        'appointment_date',
        'notes',
        'status',
    ];

    protected $dates = [
        'appointment_date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }
}
