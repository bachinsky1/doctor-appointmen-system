<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;


class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symptom $symptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        //
    }

    public function search(Request $request)
    {
        $q = $request->input('search');

        $doctors = User::select(
                'users.*',
                'medicalestablishments.name as establishment_name',
                'positions.name as position_name',
                // DB::raw('GROUP_CONCAT(DISTINCT symptoms.name SEPARATOR ", ") as symptom_names')
            )
            ->join('user_medicalestablishments', 'users.id', '=', 'user_medicalestablishments.user_id')
            ->join('medicalestablishments', 'user_medicalestablishments.medicalestablishment_id', '=', 'medicalestablishments.id')
            ->join('positions', 'user_medicalestablishments.position_id', '=', 'positions.id')
            ->join('user_specialities', 'users.id', '=', 'user_specialities.user_id')
            ->join('symptom_specialities', 'user_specialities.speciality_id', '=', 'symptom_specialities.speciality_id')
            ->join('symptoms', 'symptom_specialities.symptom_id', '=', 'symptoms.id')
            ->whereFullText(['symptoms.name'], $q, ['mode' => 'boolean', 'language' => 'automatic', 'with_query_expansion' => true, 'in_boolean_mode' => true])
            ->orWhere('users.first_name', 'LIKE', '%' . $q . '%')
            ->orWhere('users.last_name', 'LIKE', '%' . $q . '%')
            ->orWhere(DB::raw("CONCAT(users.first_name, ' ', users.last_name)"), 'LIKE', '%' . $q . '%')
            ->orWhere(DB::raw("CONCAT(users.last_name, ' ', users.first_name)"), 'LIKE', '%' . $q . '%')
            ->orWhere('positions.name', 'LIKE', '%' . $q . '%')
            ->orWhere('medicalestablishments.name', 'LIKE', '%' . $q . '%')
            ->groupBy('users.id', 'users.first_name', 'users.last_name', 'medicalestablishments.id', 'positions.id')
            ->distinct()
            ->get();

        return response()->json($doctors);
    }
}