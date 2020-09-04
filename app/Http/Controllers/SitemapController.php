<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Bank;
use App\Branch;


class SitemapController extends Controller
{
    public function index()
	{
	   return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
	}

    public function banks()
	{
		$banks =  Bank::orderBy('name')
                  ->get();
		return response()->view('sitemap.banks', ['banks' => $banks])
		      ->header('Content-Type', 'text/xml');

	} 

	public function states()
	{
		$states =  Branch::orderBy('state')
		          ->whereNotNull('state')
                  ->with('bank')->groupBy(['state','bank_id'])
                  ->get();                  
		return response()->view('sitemap.states', ['states' => $states])
		      ->header('Content-Type', 'text/xml');

	}

	public function pages(){
		return response()->view('sitemap.pages')->header('Content-Type', 'text/xml');
	}

}
