<?php

namespace App\Services\Consultation;

use App\Http\Requests\ConsultationProblemRequest;
use App\Http\Requests\ConsultationPublicIdRequest;
use App\Http\Requests\PreviousConsultationRequest;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\ConsultationMedicalNote;
use App\Models\ConsultationNote;
use App\Models\ConsultationPatientNote;
use App\Models\ConsultationProblem;
use App\Models\Unit;
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
    public function activate($id): array
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
     * @return bool
     */
    public function close(ConsultationPublicIdRequest $request): bool
    {
        $publicId = $request->input('public_id');

        $consultation = Consultation::where('public_id', $publicId)->firstOrFail();
        $consultation->is_opened = false;

        return $consultation->save();
    }

    /**
     * Summary of previous
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function previous(ConsultationPublicIdRequest $request): Collection
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
     * @param mixed $publicId
     * @return Collection|array
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
     * @return \App\Models\ConsultationMedicalNote
     */
    public function storeMedicalNote(ConsultationPublicIdRequest $request): ConsultationMedicalNote
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
     * @return bool
     */
    public function deleteMedicalNote(string $consultationId, int $noteId): bool
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
     * @return \App\Models\ConsultationPatientNote
     */
    public function patchMedicalNote(ConsultationPublicIdRequest $request): ConsultationPatientNote
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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPatientNotes($publicId): Collection
    {
        return ConsultationPatientNote::whereHas('consultation', function ($query) use ($publicId) {
            $query->where('public_id', $publicId);
        })->get();
    }

    /**
     * Summary of storePatientNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \App\Models\ConsultationPatientNote
     */
    public function storePatientNote(ConsultationPublicIdRequest $request): ConsultationPatientNote
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
     * @return bool
     */
    public function deletePatientNote(string $consultationId, int $noteId): bool
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
     * @return \App\Models\ConsultationPatientNote
     */
    public function patchPatientNote(ConsultationPublicIdRequest $request): ConsultationPatientNote
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
     * @return Collection|array
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
     * @return \App\Models\ConsultationNote
     */
    public function storeConsultationNote(ConsultationPublicIdRequest $request): ConsultationNote
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
     * @return bool
     */
    public function deleteConsultationNote(string $consultationId, int $noteId): bool
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
     * @return \App\Models\ConsultationNote
     */
    public function patchConsultationNote(ConsultationPublicIdRequest $request): ConsultationNote
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


    /**
     * Summary of getProblems
     * @param mixed $publicId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProblems($publicId): Collection
    {
        return ConsultationProblem::whereHas('consultation', function ($query) use ($publicId) {
            $query->where('public_id', $publicId);
        })->get();
    }


    /**
     * Summary of storeProblem
     * @param \App\Http\Requests\ConsultationProblemRequest $request
     * @return \App\Models\ConsultationProblem
     */
    public function storeProblem(ConsultationProblemRequest $request): ConsultationProblem
    {
        $publicId = $request->input('public_id');
        $problemData = $request->input('problem');

        $consultation = Consultation::where('public_id', $publicId)->first();
        $userId = $consultation->user_id;
        $patientId = $consultation->patient_id;

        $problem = new ConsultationProblem();
        $problem->user_id = $userId;
        $problem->patient_id = $patientId;
        $problem->consultation_id = $consultation->id;
        $problem->hierarchy_level = $problemData['hierarchy_level'];
        $problem->classification_place = $problemData['classification_place'];
        $problem->terminal_type = $problemData['terminal_type'];
        $problem->chapter_id = $problemData['chapter_id'];
        $problem->code1 = $problemData['code1'];
        $problem->code2 = $problemData['code2'];
        $problem->code3 = $problemData['code3'];
        $problem->code4 = $problemData['code4'];
        $problem->title1 = $problemData['title1'];
        $problem->title2 = $problemData['title2'];
        $problem->title3 = $problemData['title3'];
        $problem->reference1 = $problemData['reference1'];
        $problem->reference2 = $problemData['reference2'];
        $problem->reference3 = $problemData['reference3'];
        $problem->reference4 = $problemData['reference4'];
        $problem->reference5 = $problemData['reference5'];
        $problem->reference6 = $problemData['reference6'];
        $problem->save();

        $problemId = $problem->id;
        $newProblem = ConsultationProblem::find($problemId);

        return $newProblem;
    }


    /**
     * Summary of deleteProblem
     * @param string $consultationId
     * @param int $problemId
     * @return bool
     */
    public function deleteProblem(string $consultationId, int $problemId): bool
    {
        $consultation = Consultation::where('public_id', $consultationId)->first();

        return ConsultationProblem::where([
            ['id', '=', (int) $problemId],
            ['consultation_id', '=', $consultation->id]
        ])->delete();
    }

    /**
     * Summary of getVitalsignsUnits
     * @return mixed
     */
    public function getVitalSignsUnits()
    {
        return Unit::where('is_vitalsign', true)->get();
    }
}