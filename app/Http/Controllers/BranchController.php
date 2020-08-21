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
		})->whereHas('state', function($q) use ($state) {
		    $q->where('slug', $state);
		})->whereHas('district', function($q) use ($district) {
		    $q->where('slug', $district);
		})->whereHas('city', function($q) use ($city) {
            $q->where('slug', $city);
        })->with(['bank','state','district','city'])->orderBy('branch')->get();

        return response()->json($branches);
    }
}
