<?php

namespace App\Services\Consultation;

use App\Http\Requests\CloseConsultationRequest;
use App\Models\Appointment;
use App\Models\Consultation;
use Illuminate\Database\Eloquent\Collection; 
/**
 * Class ConsultationService.
 */
class ConsultationService
{
    public function __construct()
    {

    }

    /**
     * Summary of activate
     * @param mixed $id
     * @return array
     */
    public function activate($id)
    {
        $newCreated = false;
        // Looking for advice on public_id
        $consultation = Consultation::where('public_id', $id)->first();

        // If advice is not found, create a new one
        if (!$consultation) {
            // Looking for apppointment by public_id
            $appointment = Appointment::where('public_id', $id)->first();

            // Creating a new consultation
            $consultation = Consultation::create([
                'public_id' => $id,
                'type_id' => 1,
                'appointment_id' => $appointment->id,
                'user_id' => $appointment->user_id,
                'patient_id' => $appointment->patient_id,
            ]);

            $newCreated = true;
        }

        // Return the found or created consultation
        return [
            'consultation' => $consultation,
            'newCreated' => $newCreated,
        ];
    }

    /**
     * Summary of close
     * @param \App\Http\Requests\CloseConsultationRequest $request
     * @return mixed
     */
    public function close(CloseConsultationRequest $request)
    {
        $publicId = $request->input('public_id');

        $consultation = Consultation::where('public_id', $publicId)->firstOrFail();
        $consultation->is_opened = false;

        return $consultation->save();
    }
}
