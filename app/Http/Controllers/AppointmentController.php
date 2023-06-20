<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\User;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $appointments = Appointment::where('user_id', $user_id)->get(); 

        $patients = User::whereHas('roles', function ($query) {
            $query->where('name', 'patient');
        })->get();

        return response()->json([
            'appointments' => $appointments,
            'appointmentTypes' => AppointmentType::all(),
            'patients' => $patients,
        ]);
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
        
        $user = Auth::user();
        $appointment = new Appointment();

        $appointment->public_id = $request->input('public_id');
        $appointment->title = $request->input('title');
        $appointment->start = $request->input('start');
        $appointment->end = $request->input('end');
        $appointment->allDay = $request->input('allDay');
        $appointment->user_id = $user->id;
        $appointment->type_id = $request->input('type_id');
        $appointment->patient_id = $request->input('patient_id');
        $appointment->save();
 

        return response()->json(['message' => 'Data saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointments  $appointments
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointments  $appointments
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointments  $appointments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointments $appointments)
    {
        $user = Auth::user();
        // Appointment::where('id', $id)->where('user_id', $user_id)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointments  $appointments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        Appointment::where('public_id', $id)->where('user_id', $user->id)->delete();

        return response()->json(['message' => 'Data deleted successfully']);
    }
}