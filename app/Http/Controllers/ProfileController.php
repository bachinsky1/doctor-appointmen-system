<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        if (!!$user === false) {
            return response()->json(['message' => 'User not found'], 404);
        }

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
        $user = Auth::user();

        if (!!$user === false) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $phone1 = $request->input('phone1');
        $phone2 = $request->input('phone2');
        $fax = $request->input('fax');
        $birthdate = $request->input('birthdate');
        $gender = $request->input('gender');

        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->phone1 = $phone1;
        $user->phone2 = $phone2;
        $user->fax = $fax;
        $user->birthdate = $birthdate;
        $user->gender = $gender;
        $user->save();

        return response()->json(['message' => 'Contact info updated successfully']);
    }

    public function updateAddress(Request $request, Profile $profile)
    {
        $user = Auth::user();

        if (!!$user === false) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message' => $request->input('addresses')]);
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