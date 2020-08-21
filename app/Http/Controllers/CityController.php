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

        $cities = Branch::whereHas('bank', function($q) use ($bank) {
            $q->where('slug', $bank);
        })->whereStateSlug($state)
        ->whereDistrictSlug($district)
        ->whereNotNull('city')
        ->select('city as name','city_slug as slug')
        ->groupBy('city')->get();

        //$cities = City::whereIn('id',$citiesId)->orderBy('name')->get();

        return response()->json($cities);
    }
}
