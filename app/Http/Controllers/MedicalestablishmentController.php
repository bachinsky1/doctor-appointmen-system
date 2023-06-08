<?php

namespace App\Http\Controllers;

use App\Models\Medicalestablishment;
use Illuminate\Http\Request;

class MedicalestablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $medests = Medicalestablishment::select('id', 'name', 'address', 'type_id', 'created_at', 'updated_at', 'deleted_at') 
            ->withTrashed() 
            ->paginate(10);

        return view('medicalestablishments.index', [
            'medests' => $medests,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicalestablishment  $medicalestablishment
     * @return \Illuminate\Http\Response
     */
    public function show(Medicalestablishment $medicalestablishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicalestablishment  $medicalestablishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicalestablishment $medicalestablishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicalestablishment  $medicalestablishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicalestablishment $medicalestablishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicalestablishment  $medicalestablishment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medest = Medicalestablishment::find($id);

        if ($medest) {
            $medest->delete();
            session()->flash('message', 'Medicalestablishment has been deleted!');
            session()->flash('class', 'success');

            return redirect()->route('medicalestablishments');
        } else {
            session()->flash('message', 'Medicalestablishment not found!');
            session()->flash('class', 'warning');

            return redirect()->route('medicalestablishments');
        }
    }
}
