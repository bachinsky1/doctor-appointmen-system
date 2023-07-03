<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Icd10Controller extends Controller
{
    public function search(Request $request)
    {
        $q = $request->input('search');
        return $q;
    }
}
