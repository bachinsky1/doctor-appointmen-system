<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateAddress;
use App\Http\Requests\ProfileUpdateContact;
use App\Http\Requests\ProfileUpdateWorkplace;
use App\Models\Medicalestablishment;
use App\Models\Position;
use App\Models\Profile;
use App\Models\UserMedicalestablishment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\AddressLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function getContact()
    {
        $user = Auth::user();

        return response()->json([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone1' => $user->phone1,
            'phone2' => $user->phone2,
            'fax' => $user->fax,
            'birthdate' => $user->birthdate,
            'gender' => $user->gender,
        ]);
    }

    public function getAddress()
    {
        $user = Auth::user();

        // get all addresses associated with the current user
        $addresses = $user->addresses()->get();

        return response()->json($addresses);
    }

    public function getWorkplace()
    {
        $user = Auth::user();

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

    public function updateWorkplace(ProfileUpdateWorkplace $request)
    {

        $user = Auth::user();

        UserMedicalEstablishment::where('user_id', $user->id)->forceDelete();

        foreach ($request->workplaces as $workplaceData) {
            UserMedicalEstablishment::updateOrCreate([
                'user_id' => $user->id,
                'medicalestablishment_id' => $workplaceData['medicalestablishment_id']
            ], ['position_id' => $workplaceData['position_id']]);
        }

        return response()->json(['message' => 'Data saved successfully']);
    }

    public function updateContact(ProfileUpdateContact $request, Profile $profile)
    {
        try {
            $user = Auth::user();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->birthdate = $request->input('birthdate');
            $user->gender = $request->input('gender');
            $user->phone1 = $request->input('phone1');
            $user->phone2 = $request->input('phone2');
            $user->fax = $request->input('fax');
            $user->save();
            return $this->responseUpdateSuccess(['record' => $user->fresh()]);
        } catch (\Exception $e) {
            return $this->responseUpdateFail();
            // return response()->json(['message' => 'Failed to update contact info'], 500);
        }



        // return response()->json(['message' => 'Contact info updated successfully']);
    }

    public function updateAddress(ProfileUpdateAddress $request)
    {
        $user = Auth::user();

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

        return response()->json(['message' => 'Data saved successfully']);

    }

}