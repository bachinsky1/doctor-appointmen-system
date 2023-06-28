<?php

namespace App\Http\Controllers;

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
     * Summary of destroy
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function destroy(Consultations $consultations)
    {
        //
    }
}