<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationPublicIdRequest;
use App\Models\Icd10Code;
use Illuminate\Http\Request;

class Icd10Controller extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        
        $results = Icd10Code::with('chapter')
            ->where(function ($q) use ($query) {
                $q->where('code1', '=', $query)
                    ->orWhere('code2', '=', $query)
                    ->orWhere('code3', '=', $query)
                    ->orWhere('code4', '=', $query)
                    ->orWhere('title1', 'like', "%$query%")
                    ->orWhere('title2', 'like', "%$query%")
                    ->orWhere('title3', 'like', "%$query%");
            })->take(10)
            ->get();

        return $results;
    }

    public function getProblems($id)
    {
        // $patient = Patient::findOrFail($id);
        // $problems = $patient->problems;
        return response()->json(['message' => 'Problems retrieved', 'problems' => []], 200);
    }

    public function storeProblem(ConsultationPublicIdRequest $request)
    {
        // $patient = Patient::findOrFail($id);
        // $problem = new Problem();
        // $problem->description = $request->input('description');
        // // дополнительные поля проблемы
        // $patient->problems()->save($problem);
        return response()->json(['message' => 'Problem created'], 201);
    }

    public function deleteProblem($consultationId, $problem_id)
    {
        // $patient = Patient::findOrFail($id);
        // $problem = $patient->problems()->findOrFail($problem_id);
        // $problem->delete();
        return response()->json(['message' => 'Problem deleted'], 200);
    }



}
