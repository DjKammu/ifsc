<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;


class BankController extends Controller
{
    public function get(Request $request)
    {
        $banks = Bank::orderBy('name')->get();
        return response()->json($banks);
    }
}
