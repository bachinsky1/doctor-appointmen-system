<?php

namespace App\Http\Controllers;

use App\Http\Requests\CloseConsultationRequest;
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
     * @param \App\Http\Requests\CloseConsultationRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function close(CloseConsultationRequest $request): JsonResponse
    {
        $result = $this->consultationService->close($request);

        return !!$result
            ? response()->json(['message' => 'Consultation closed successfully'])
            : response()->json(['message' => 'Error occurs during closing consultation'], 500);
    }

    /**
     * Summary of destroy
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function destroy(Consultations $consultations)
    {
        //
    }
}