<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationPublicIdRequest;
use App\Http\Requests\Icd10SearchRequest;
use App\Models\Consultation;
use App\Models\ConsultationProblem;
use App\Models\Icd10Code;
use App\Services\Icd10\Icd10Service;
use Symfony\Component\HttpFoundation\JsonResponse;

class Icd10Controller extends Controller
{
    private Icd10Service $icd10Service;

    public function __construct(Icd10Service $icd10Service)
    {
        $this->icd10Service = $icd10Service;
    }

    /**
     * Summary of search
     * @param \App\Http\Requests\Icd10SearchRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function search(Icd10SearchRequest $request): JsonResponse
    {
        $result = $this->icd10Service->search($request);
        return response()->json($result);
    }

}