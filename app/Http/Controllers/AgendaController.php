<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchPatientRequest;
use App\Http\Requests\StoreAppointmentRequest; 
use App\Models\User;
use App\Services\Agenda\AgendaService;
use App\Services\Patient\PatientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    private AgendaService $agendaService;
    private PatientService $patientService;

    /**
     * Summary of __construct
     * @param \App\Services\Agenda\AgendaService $agendaService
     * @param \App\Services\Patient\PatientService $patientService
     */
    public function __construct(AgendaService $agendaService, PatientService $patientService)
    {
        $this->agendaService = $agendaService;
        $this->patientService = $patientService;
    }

    /**
     * Summary of index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response(404)->json(['message' => 'Stub'], 404);
    }

    /**
     * Summary of create
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(): JsonResponse
    {
        return response()->json(['message' => 'Stub'], 404);
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\StoreAppointmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAppointment(StoreAppointmentRequest $request): JsonResponse
    {
        $result = $this->agendaService->storeAppointment($request);

        return !!$result
            ? response()->json(['message' => 'Data saved successfully'])
            : response()->json(['message' => 'Error'], 500);

    }

    /**
     * Summary of show
     * @param mixed $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($user_id = null): JsonResponse
    { 
        $user_id = intval($user_id);
        return response()->json($this->agendaService->getAppointments($user_id));
    }

    /**
     * Summary of destroy
     * @param mixed $public_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($public_id): JsonResponse
    {
        $result = $this->agendaService->destroyAppointment($public_id);

        return !!$result
            ? response()->json(['message' => 'Data deleted successfully'])
            : response()->json(['message' => 'Error'], 500);
    }

    public function edit(): JsonResponse
    {
        return response(404)->json(['message' => 'Stub'], 404);
    }

    public function update(): JsonResponse
    {
        return response(404)->json(['message' => 'Stub'], 404);
    }

    public function searchPatient(SearchPatientRequest $request) : JsonResponse
    {
        $search = $request->input('search');
        $result = $this->agendaService->searchPatient($search);
        
        return response()->json($result);
    }

    public function getAppointmentTypes(): JsonResponse
    {
        return response()->json($this->agendaService->getAppointmentTypes());
    }

    public function approveAppointment(Request $request): JsonResponse
    {
        $result = $this->agendaService->approveAppointment($request->public_id);
        return  response()->json($result);
    }

}