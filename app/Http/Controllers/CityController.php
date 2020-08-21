<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Branch;


class CityController extends Controller
{
    public function get(Request $request)
    {
        $district = $request->get('district');
        $state    = $request->get('state');
        $bank     = $request->get('bank');

        $citiesId = Branch::whereHas('bank', function($q) use ($bank) {
		    $q->where('slug', $bank);
		})->whereHas('state', function($q) use ($state) {
		    $q->where('slug', $state);
		})->whereHas('district', function($q) use ($district) {
		    $q->where('slug', $district);
		})->pluck('city_id')->unique();

        $cities = City::whereIn('id',$citiesId)->orderBy('name')->get();

        return response()->json($cities);
    }
}
