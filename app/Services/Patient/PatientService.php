<?php

namespace App\Services\Patient;
use App\Models\User;

/**
 * Class PatientService.
 */
class PatientService
{
    public function getPatients($user_id = null) // user_id - is a doctor ID stub for future
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'patient');
        })->get();
    }
}
