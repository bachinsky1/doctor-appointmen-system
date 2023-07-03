<?php

namespace App\Http\Controllers;

use App\Models\Icd10Code;
use Illuminate\Http\Request;

class Icd10Controller extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        
        $results = Icd10Code::with('chapter')
            ->where(function ($q) use ($query) {
                $q->where('code1', '=', $query)
                    ->orWhere('code2', '=', $query)
                    ->orWhere('code3', '=', $query)
                    ->orWhere('code4', '=', $query)
                    ->orWhere('title1', 'like', "%$query%")
                    ->orWhere('title2', 'like', "%$query%")
                    ->orWhere('title3', 'like', "%$query%");
            })->take(10)
            ->get();

        return $results;
    }
}
