<?php

namespace App\Services\Consultation;

use App\Http\Requests\ConsultationPublicIdRequest;
use App\Http\Requests\PreviousConsultationRequest;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\ConsultationMedicalNote;
use App\Models\ConsultationNote;
use App\Models\ConsultationPatientNote;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth; 
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
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return mixed
     */
    public function close(ConsultationPublicIdRequest $request)
    {
        $publicId = $request->input('public_id');

        $consultation = Consultation::where('public_id', $publicId)->firstOrFail();
        $consultation->is_opened = false;

        return $consultation->save();
    }

    /**
     * Summary of previous
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return Collection
     */
    public function previous(ConsultationPublicIdRequest $request)
    {
        $publicId = $request->input('public_id');
        $consultation = Consultation::where('public_id', $publicId)->first();
        $patientId = $consultation->patient_id;

        $consultations = Consultation::with('type')
            ->where('patient_id', $patientId)
            ->whereNotIn('public_id', [$publicId])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($consultation) {
                return date('Y-m-d', strtotime($consultation->created_at));
            });

        return $consultations;
    }

    /**
     * Summary of getMedicalNotes
     * @param string $id
     * @return mixed
     */
    public function getMedicalNotes($publicId)
    {
        return ConsultationMedicalNote::whereHas('consultation', function ($query) use ($publicId) {
            $query->where('public_id', $publicId);
        })->get();
    }

    /**
     * Summary of storeMedicalNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return mixed
     */
    public function storeMedicalNote(ConsultationPublicIdRequest $request)
    {
        $public_id = $request->input('public_id');
        $consultation = Consultation::where('public_id', $public_id)->first();

        $note = ConsultationMedicalNote::create([ 
            'note' => $request->input('note'),
            'user_id' => $consultation->user_id,
            'patient_id' => $consultation->patient_id,
            'consultation_id' => $consultation->id,
        ]);

        return $note;
    }

    /**
     * Summary of deleteMedicalNote
     * @param string $consultationId
     * @param int $noteId
     * @return mixed
     */
    public function deleteMedicalNote(string $consultationId, int $noteId)
    {
        $public_id = $consultationId;
        $note_id = $noteId;
        $consultation = Consultation::where('public_id', $public_id)->first();

        return ConsultationMedicalNote::where([
            ['id', '=', $note_id],
            ['consultation_id', '=', $consultation->id]
        ])->delete();
    }

    /**
     * Summary of patchMedicalNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return mixed
     */
    public function patchMedicalNote(ConsultationPublicIdRequest $request)
    {
        $public_id = $request->input('public_id');
        $note_id = $request->input('note_id');
 
        $consultation = Consultation::where('public_id', $public_id)->firstOrFail();
 
        $note = ConsultationMedicalNote::where('id', $note_id)
            ->where('consultation_id', $consultation->id)
            ->firstOrFail();

        $note->note = $request->input('note');
        $note->save();

        return $note;
    }

    /**
     * Summary of getPatientNotes
     * @param mixed $publicId
     * @return mixed
     */
    public function getPatientNotes($publicId)
    {
        return ConsultationPatientNote::whereHas('consultation', function ($query) use ($publicId) {
            $query->where('public_id', $publicId);
        })->get();
    }

    /**
     * Summary of storePatientNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return mixed
     */
    public function storePatientNote(ConsultationPublicIdRequest $request)
    {
        $public_id = $request->input('public_id');
        $consultation = Consultation::where('public_id', $public_id)->first();

        $note = ConsultationPatientNote::create([ 
            'note' => $request->input('note'),
            'user_id' => $consultation->user_id,
            'patient_id' => $consultation->patient_id,
            'consultation_id' => $consultation->id,
        ]);

        return $note;
    }

    /**
     * Summary of deletePatientNote
     * @param string $consultationId
     * @param int $noteId
     * @return mixed
     */
    public function deletePatientNote(string $consultationId, int $noteId)
    {
        $public_id = $consultationId;
        $note_id = $noteId;
        $consultation = Consultation::where('public_id', $public_id)->first();

        return ConsultationPatientNote::where([
            ['id', '=', $note_id],
            ['consultation_id', '=', $consultation->id]
        ])->delete();
    }

    /**
     * Summary of patchPatientNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return mixed
     */
    public function patchPatientNote(ConsultationPublicIdRequest $request)
    {
        $public_id = $request->input('public_id');
        $note_id = $request->input('note_id');
 
        $consultation = Consultation::where('public_id', $public_id)->firstOrFail();
 
        $note = ConsultationPatientNote::where('id', $note_id)
            ->where('consultation_id', $consultation->id)
            ->firstOrFail();

        $note->note = $request->input('note');
        $note->save();

        return $note;
    }

    /**
     * Summary of getConsultationNotes
     * @param mixed $publicId
     * @return mixed
     */
    public function getConsultationNotes($publicId)
    {
        return ConsultationNote::whereHas('consultation', function ($query) use ($publicId) {
            $query->where('public_id', $publicId);
        })->get();
    }

    /**
     * Summary of storeConsultationNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return mixed
     */
    public function storeConsultationNote(ConsultationPublicIdRequest $request)
    {
        $public_id = $request->input('public_id');
        $consultation = Consultation::where('public_id', $public_id)->first();

        $note = ConsultationNote::create([ 
            'note' => $request->input('note'),
            'user_id' => $consultation->user_id,
            'patient_id' => $consultation->patient_id,
            'consultation_id' => $consultation->id,
        ]);

        return $note;
    }

    /**
     * Summary of deleteConsultationNote
     * @param string $consultationId
     * @param int $noteId
     * @return mixed
     */
    public function deleteConsultationNote(string $consultationId, int $noteId)
    {
        $public_id = $consultationId;
        $note_id = $noteId;
        $consultation = Consultation::where('public_id', $public_id)->first();

        return ConsultationNote::where([
            ['id', '=', $note_id],
            ['consultation_id', '=', $consultation->id]
        ])->delete();
    }

    /**
     * Summary of patchConsultationNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return mixed
     */
    public function patchConsultationNote(ConsultationPublicIdRequest $request)
    {
        $public_id = $request->input('public_id');
        $note_id = $request->input('note_id');
 
        $consultation = Consultation::where('public_id', $public_id)->firstOrFail();
 
        $note = ConsultationNote::where('id', $note_id)
            ->where('consultation_id', $consultation->id)
            ->firstOrFail();

        $note->note = $request->input('note');
        $note->save();

        return $note;
    }
}
