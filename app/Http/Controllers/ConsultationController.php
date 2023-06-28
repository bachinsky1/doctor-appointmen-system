<?php

namespace App\Http\Controllers;

use App\Models\Consultations;
use App\Services\Consultation\ConsultationService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConsultationController extends Controller
{
    private ConsultationService $consultationService;

    public function __construct(ConsultationService $consultationService)
    {
        $this->consultationService = $consultationService; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        return response()->json([]);
    }

    public function activate($id): JsonResponse
    {
        $result = $this->consultationService->activate($id);
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultations  $consultations
     * @return \Illuminate\Http\Response
     */
    public function show(Consultations $consultations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultations  $consultations
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultations $consultations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultations  $consultations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultations $consultations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultations  $consultations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultations $consultations)
    {
        //
    }
}