<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Branch;


class StateController extends Controller
{
    public function get(Request $request)
    {
        $bank = $request->get('bank');

        $states = Branch::whereHas('bank', function($q) use ($bank) {
		    $q->where('slug', $bank);
		})->whereNotNull('state')
		->select('state as name','state_slug as slug')
		->groupBy('state')->get();
		
        //$states = State::whereIn('id',$statesId)->orderBy('name')->get();

        return response()->json($states);
    }
}
