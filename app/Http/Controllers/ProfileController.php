<?php

namespace App\Http\Controllers;

use App\Models\Medicalestablishment;
use App\Models\Position;
use App\Models\Profile;
use App\Models\UserMedicalestablishment;
use App\Models\UserPosition;
use App\Models\UserSpeciality;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\AddressLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    }

    public function getContact(Request $request)
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

    public function getAddress(Request $request)
    {
        $user = Auth::user();

        // get all addresses associated with the current user
        $addresses = $user->addresses()->get();

        return response()->json($addresses);
    }

    public function getWorkplace()
    {
        $user = auth()->user();

        $workplaces = UserMedicalEstablishment::with(['position', 'medicalEstablishment'])
            ->where('user_id', $user->id)
            ->get();

        $positions = Position::all();
        $medicalestablishments = Medicalestablishment::all();

        return response()->json([
            'workplaces' => $workplaces,
            'positions' => $positions,
            'medicalestablishments' => $medicalestablishments,
            'userId' => $user->id,
        ]);
    }

    public function updateWorkplace(Request $request)
    {
        
        $user = Auth::user();

        if (!!$user === false) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'workplaces' => 'required|array',
            'workplaces.*.user_id' => 'required|integer',
            'workplaces.*.medicalestablishment_id' => 'required|integer',
            'workplaces.*.position_id' => 'nullable|integer', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There are validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        UserMedicalEstablishment::where('user_id', $user->id)->forceDelete();

        foreach ($request->workplaces as $workplaceData) {
            UserMedicalEstablishment::updateOrCreate([
                'user_id' => $user->id,
                'medicalestablishment_id' => $workplaceData['medicalestablishment_id']
            ], [
                    'position_id' => $workplaceData['position_id']
                ]);
        }

        return response()->json(['message' => 'Data saved successfully']);
    }

    public function updateContact(Request $request, Profile $profile)
    {
        $user = Auth::user();

        if (!!$user === false) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'gender' => 'required|in:M,F',
            'phone1' => 'required|string|max:255',
            'phone2' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There are validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->birthdate = $request->input('birthdate');
        $user->gender = $request->input('gender');
        $user->phone1 = $request->input('phone1');
        $user->phone2 = $request->input('phone2');
        $user->fax = $request->input('fax');

        $user->save();

        return response()->json(['message' => 'Contact info updated successfully']);
    }

    public function updateAddress(Request $request, Profile $profile)
    {
        $user = Auth::user();

        if (!!$user === false) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validation of incoming data
        $validator = Validator::make($request->all(), [
            'addresses' => 'required|array',
            'addresses.*.street' => 'required|string|max:255',
            'addresses.*.house_number' => 'required|string|max:255',
            'addresses.*.city' => 'required|string|max:255',
            'addresses.*.state' => 'required|string|max:255',
            'addresses.*.zip_code' => 'required|string|max:255',
            'addresses.*.is_main_address' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There are validation errors', 
                'errors' => $validator->errors()
            ], 400);
        }


        $addresses = $request->input('addresses');
        $savedAddresses = [];
        $userId = $user->id;

        DB::beginTransaction();

        // Clearing the address_links table
        DB::table('address_links')->where('user_id', $userId)->delete();
        // Clearing the addresses table
        DB::table('addresses')
            ->leftJoin('address_links', 'addresses.id', '=', 'address_links.address_id')
            ->whereNull('address_links.id')
            ->delete();

        // Saving addresses in the addresses table
        try {
            foreach ($addresses as $addressData) {
                $address = new Address();
                $address->street = $addressData['street'];
                $address->house_number = $addressData['house_number'];
                $address->city = $addressData['city'];
                $address->state = $addressData['state'];
                $address->zip_code = $addressData['zip_code'];
                $address->is_main_address = $addressData['is_main_address'];
                $address->save();

                $savedAddresses[] = $address;
            }

            // Linking addresses to the current user in the address_links table

            foreach ($savedAddresses as $address) {
                $addressLink = new AddressLink();
                $addressLink->address_id = $address->id;
                $addressLink->user_id = Auth::id();
                $addressLink->is_main = $address->is_main_address;
                $addressLink->save();
            }

            DB::commit();

        } catch (\Exception $e) {
            // If an error occurs, rollback the transaction and return an error
            DB::rollback();

            return response()->json(['message' => 'Failed to save addresses'], 500);
        }

        return response()->json(['message' => 'Form submitted successfully.']);

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