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
        $symptom = $request->input('search');
        // $symptoms = DB::table('symptoms')->whereFullText('name', $query)->take(10)->get();

        $doctors = User::select('users.*', 'medicalestablishments.name as establishment_name', 'positions.name as position_name')
            ->join('user_medicalestablishments', 'users.id', '=', 'user_medicalestablishments.user_id')
            ->join('medicalestablishments', 'user_medicalestablishments.medicalestablishment_id', '=', 'medicalestablishments.id')
            ->join('positions', 'user_medicalestablishments.position_id', '=', 'positions.id')
            ->join('user_specialities', 'users.id', '=', 'user_specialities.user_id')
            ->join('symptom_specialities', 'user_specialities.speciality_id', '=', 'symptom_specialities.speciality_id')
            ->join('symptoms', 'symptom_specialities.symptom_id', '=', 'symptoms.id')
            ->where(function ($query) use ($symptom) {
                $query->whereFullText('symptoms.name', $symptom)
                    ->orWhere('users.first_name', 'LIKE', '%' . $symptom . '%')
                    ->orWhere('users.last_name', 'LIKE', '%' . $symptom . '%');
            })
            ->groupBy('users.id', 'medicalestablishments.id', 'positions.id')
            ->take(10)
            ->get();



        return response()->json($doctors); 
    }
}
