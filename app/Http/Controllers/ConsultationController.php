<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationProblemRequest;
use App\Http\Requests\ConsultationPublicIdRequest; 
use App\Models\Consultation;
use App\Models\ConsultationProblem;
use App\Models\Consultations;
use App\Services\Consultation\ConsultationService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConsultationController extends Controller
{
    private ConsultationService $consultationService;

    /**
     * Summary of __construct
     * @param \App\Services\Consultation\ConsultationService $consultationService
     */
    public function __construct(ConsultationService $consultationService)
    {
        $this->consultationService = $consultationService; 
    }

    /**
     * Summary of activate
     * @param mixed $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function activate($id): JsonResponse
    {
        $result = $this->consultationService->activate($id);
        return response()->json($result);
    }

    /**
     * Summary of close
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function close(ConsultationPublicIdRequest $request): JsonResponse
    {
        $result = $this->consultationService->close($request);

        return !!$result
            ? response()->json(['message' => 'Consultation closed successfully'])
            : response()->json(['message' => 'Error occurs during closing consultation'], 500);
    }

    /**
     * Summary of previous
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function previous(ConsultationPublicIdRequest $request): JsonResponse
    {
        $result = $this->consultationService->previous($request);

        return response()->json($result);
    }

    /**
     * Summary of getMedicalNotes
     * @param mixed $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getMedicalNotes($id): JsonResponse
    {
        $result = $this->consultationService->getMedicalNotes($id);

        return response()->json($result);
    }

    /**
     * Summary of getPatientNotes
     * @param mixed $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getPatientNotes($id): JsonResponse
    { 
        $result = $this->consultationService->getPatientNotes($id);

        return response()->json($result);
    }
    
    /**
     * Summary of storePatientNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function storePatientNote(ConsultationPublicIdRequest $request): JsonResponse
    {
        $result = $this->consultationService->storePatientNote($request);

        return response()->json($result);
    }

    /**
     * Summary of deletePatientNote
     * @param string $consultationId
     * @param int $noteId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deletePatientNote(string $consultationId, int $noteId): JsonResponse
    {
        $result = $this->consultationService->deletePatientNote($consultationId, $noteId);

        return response()->json($result);
    }

    /**
     * Summary of patchPatientNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function patchPatientNote(ConsultationPublicIdRequest $request): JsonResponse
    {
        $result = $this->consultationService->patchPatientNote($request);

        return response()->json($result);
    }

    /**
     * Summary of getConsultationNotes
     * @param mixed $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getConsultationNotes($id): JsonResponse
    {
        $result = $this->consultationService->getConsultationNotes($id);

        return response()->json($result);
    }

    /**
     * Summary of storeConsultationNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function storeConsultationNote(ConsultationPublicIdRequest $request): JsonResponse
    {
        $result = $this->consultationService->storeConsultationNote($request);

        return response()->json($result);
    }

    /**
     * Summary of deleteConsultationNote
     * @param string $consultationId
     * @param int $noteId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteConsultationNote(string $consultationId, int $noteId): JsonResponse
    {
        $result = $this->consultationService->deleteConsultationNote($consultationId, $noteId);

        return response()->json($result);
    }

    /**
     * Summary of patchConsultationNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function patchConsultationNote(ConsultationPublicIdRequest $request): JsonResponse
    {
        $result = $this->consultationService->patchConsultationNote($request);

        return response()->json($result);
    }

    /**
     * Summary of storeMedicalNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function storeMedicalNote(ConsultationPublicIdRequest $request): JsonResponse
    { 
        $result = $this->consultationService->storeMedicalNote($request);

        return response()->json($result);
    }

    /**
     * Summary of deleteMedicalNote
     * @param string $consultationId
     * @param int $noteId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteMedicalNote(String $consultationId, int $noteId): JsonResponse
    {
        $result = $this->consultationService->deleteMedicalNote($consultationId, $noteId);

        return response()->json($result);
    }

    /**
     * Summary of patchMedicalNote
     * @param \App\Http\Requests\ConsultationPublicIdRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function patchMedicalNote(ConsultationPublicIdRequest $request): JsonResponse
    {
        $result = $this->consultationService->patchMedicalNote($request);

        return response()->json($result);
    }


    public function getProblems($id): JsonResponse
    {
        $result = $this->consultationService->getProblems($id);
        return response()->json($result);
    }

    public function storeProblem(ConsultationProblemRequest $request): JsonResponse
    {
        $result = $this->consultationService->storeProblem($request);
        return response()->json($result);
    }

    public function deleteProblem($consultationId, $problemId)
    {
        $result = $this->consultationService->deleteProblem($consultationId, $problemId);

        return response()->json($result);
    }

}