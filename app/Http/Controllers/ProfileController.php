<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        return view('profile.index');
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile 
     */
    public function update(Request $request, Profile $profile)
    { 
        return response()->json(['message' => 'Form submitted successfully.']);
    }


    public function getContactInfo(Request $request)
    {
        $user = User::find($request->user()->id);

        return response()->json([
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'phone1' => $user->phone1,
            'phone2' => $user->phone2,
            'fax' => $user->fax,
            'birthdate' => $user->birthdate,
            'gender' => $user->gender,
        ]);
    }

    public function updateContactInfo(Request $request, Profile $profile)
    {

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $phone1 = $request->input('phone1');
        $phone2 = $request->input('phone2');
        $fax = $request->input('fax');
        $birthdate = $request->input('birthdate');
        $gender = $request->input('gender');

        return response()->json(['message' => [
                $firstname,
                $lastname,
                $phone1,
                $phone2,
                $fax,
                $birthdate,
                $gender,
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
