<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Bank;
use App\Branch;


class SitemapController extends Controller
{
    CONST SITEMAP_LIMIT = 30000;

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

	public function districts()
	{
		$districts =  Branch::orderBy('district')
		          ->whereNotNull('state')
		          ->whereNotNull('district')
                  ->with('bank')->groupBy(['district','state','bank_id'])
                  ->get();                        
		return response()->view('sitemap.districts', ['districts' => $districts])
		      ->header('Content-Type', 'text/xml');

	}

	public function cities()
	{
		$cities =  Branch::orderBy('city')
		          ->whereNotNull('state')
		          ->whereNotNull('district')
		          ->whereNotNull('city')
                  ->with('bank')->groupBy(['city','district','state','bank_id'])
                  ->limit(self::SITEMAP_LIMIT)->get();        

		return response()->view('sitemap.cities', ['cities' => $cities])
		      ->header('Content-Type', 'text/xml');

	}

	public function pages(){
		return response()->view('sitemap.pages')->header('Content-Type', 'text/xml');
	}

}
