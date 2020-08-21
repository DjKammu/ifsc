<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Branch;


class DistrictController extends Controller
{
    public function get(Request $request)
    {
        $bank = $request->get('bank');
        $state = $request->get('state');

        $districts = Branch::whereHas('bank', function($q) use ($bank) {
            $q->where('slug', $bank);
        })->whereStateSlug($state)
        ->whereNotNull('district')
        ->select('district as name','district_slug as slug')
        ->groupBy('district')->get();
        
        //$districts = District::whereIn('id',$districtsId)->orderBy('name')->get();

        return response()->json($districts);
    }
}
