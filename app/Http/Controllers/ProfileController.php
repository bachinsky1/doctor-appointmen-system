<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\AddressLinks;
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
        // Валидация входящих данных
        $validatedData = $request->validate([
            'street.*' => 'required|string|max:255',
            'house_number.*' => 'required|string|max:255',
            'city.*' => 'required|string|max:255',
            'state.*' => 'required|string|max:255',
            'zip_code.*' => 'required|string|max:255',
            'is_main_address.*' => 'nullable|boolean',
        ]);

        // Сохранение адресов в таблице addresses
        $addresses = [];
        foreach ($validatedData['street'] as $key => $value) {
            $address = new Address;
            $address->street = $validatedData['street'][$key];
            $address->house_number = $validatedData['house_number'][$key];
            $address->city = $validatedData['city'][$key];
            $address->state = $validatedData['state'][$key];
            $address->zip_code = $validatedData['zip_code'][$key];
            $address->is_main_address = isset($validatedData['is_main_address'][$key]) ? true : false;
            $address->save();
            $addresses[] = $address;
        }

        // Привязка адресов к текущему пользователю в таблице address_links
        foreach ($addresses as $address) {
            $addressLink = new AddressLinks;
            $addressLink->address_id = $address->id;
            $addressLink->user_id = Auth::id();
            $addressLink->is_main = $address->is_main_address;
            $addressLink->save();
        }

        // return redirect()->back()->with('success', 'Адреса успешно сохранены');

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
            return response()->json(['errors' => $validator->errors()], 400);
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
                $addressLink = new AddressLinks();
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