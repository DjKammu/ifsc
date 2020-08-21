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

        $statesId = Branch::whereHas('bank', function($q) use ($bank) {
		    $q->where('slug', $bank);
		})->pluck('state_id')->unique();

        $states = State::whereIn('id',$statesId)->orderBy('name')->get();

        return response()->json($states);
    }
}
