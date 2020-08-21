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

        $districtsId = Branch::whereHas('bank', function($q) use ($bank) {
		    $q->where('slug', $bank);
		})->whereHas('state', function($q) use ($state) {
		    $q->where('slug', $state);
		})->pluck('district_id')->unique();

        $districts = District::whereIn('id',$districtsId)->orderBy('name')->get();

        return response()->json($districts);
    }
}
