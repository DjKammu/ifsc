<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Branch;


class BranchController extends Controller
{
    public function get(Request $request)
    {
        $district = $request->get('district');
        $state    = $request->get('state');
        $bank     = $request->get('bank');
        $city     = $request->get('city');

        $branches = Branch::whereHas('bank', function($q) use ($bank) {
            $q->where('slug', $bank);
        })->whereStateSlug($state)
        ->whereDistrictSlug($district)
        ->whereCitySlug($city)
        ->whereNotNull('branch')
        //->select('city as name','city_slug as slug')
        ->with('bank')->orderBy('branch')->get();

        return response()->json($branches);
    } 

    public function getFormIFSC(Request $request)
    {
        $ifsc = $request->get('ifsc');

        $branch = Branch::whereIfscCode($ifsc)
        ->with('bank')->first();

        return response()->json($branch);
    }
}
