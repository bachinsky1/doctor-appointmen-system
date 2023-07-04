<?php

namespace App\Services\Icd10;

use App\Http\Requests\Icd10SearchRequest;
use App\Models\Icd10Code;
use Illuminate\Support\Facades\Request;

/**
 * Class Icd10Service.
 */
class Icd10Service
{
    public function __construct()
    {
    }

    /**
     * Summary of search
     * @param \App\Http\Requests\Icd10SearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|array<\Illuminate\Database\Eloquent\Builder>
     */
    public function search(Icd10SearchRequest $request)
    {

        $query = $request->input('search');

        return Icd10Code::with('chapter')
            ->where(function ($q) use ($query) {
                $q->where('code1', '=', $query)
                    ->orWhere('code2', '=', $query)
                    ->orWhere('code3', '=', $query)
                    ->orWhere('code4', '=', $query)
                    ->orWhere('title1', 'like', "%$query%")
                    ->orWhere('title2', 'like', "%$query%")
                    ->orWhere('title3', 'like', "%$query%");
            })->take(15)
            ->get();
    }
}