<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest; 
use App\Services\Agenda\AgendaService;
use App\Services\Patient\PatientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth; 

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
    public function store(StoreAppointmentRequest $request): JsonResponse
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
        $user = Auth::user();

        // Create an array with the appointments and appointment types data obtained from the agenda service
        $data = [
            'appointments' => $this->agendaService->getAppointments($user_id),
            'appointmentTypes' => $this->agendaService->getAppointmentTypes(),
        ];

        // If the user is a healthcare provider, add the patients data obtained from the patient service to the data array
        if ($user->isA('healthcare')) {
            $data['patients'] = $this->patientService->getPatients($user_id);
        }

        return response()->json($data);
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


}