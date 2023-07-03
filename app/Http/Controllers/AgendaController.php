<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeAppointmentRequest;
use App\Http\Requests\GetAppointmentsRequest;
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
     * Summary of change
     * @param \App\Http\Requests\ChangeAppointmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeAppointment(ChangeAppointmentRequest $request): JsonResponse
    {
        $result = $this->agendaService->changeAppointment($request);

        return !!$result
            ? response()->json(['message' => 'Data saved successfully'])
            : response()->json(['message' => 'Error'], 500);

    }

    /**
     * Summary of show
     * @param mixed Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(GetAppointmentsRequest $request): JsonResponse
    { 
        
        return response()->json($this->agendaService->getAppointments($request));
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

    /**
     * Summary of searchPatient
     * @param \App\Http\Requests\SearchPatientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPatient(SearchPatientRequest $request) : JsonResponse
    {
        $search = $request->input('search');
        $result = $this->agendaService->searchPatient($search);
        
        return response()->json($result);
    }

    /**
     * Summary of getAppointmentTypes
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAppointmentTypes(): JsonResponse
    {
        return response()->json($this->agendaService->getAppointmentTypes());
    }

    /**
     * Summary of approveAppointment
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveAppointment(Request $request): JsonResponse
    {
        $result = $this->agendaService->approveAppointment($request->public_id);
        return  response()->json($result);
    }

}