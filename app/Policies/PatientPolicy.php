<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Patient $patient)
    {
        return $user->id === $patient->user_id || $user->is_vet;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Patient $patient)
    {
        return $user->id === $patient->user_id;
    }

    public function delete(User $user, Patient $patient)
    {
        return $user->id === $patient->user_id;
    }

    public function restore(User $user, Patient $patient)
    {
        return $user->id === $patient->user_id;
    }

    public function forceDelete(User $user, Patient $patient)
    {
        return $user->id === $patient->user_id;
    }
}
