<?php

namespace App\Http\Controllers;

use Stevebauman\Location\Facades\Location as LocationLib;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Location;
use App\Keyword;
use App\Branch;
use App\City;

class MetaController extends Controller
{
    public function get(Request $request)
    {
        $description = config('description');
        $keywords = config('keywords');
        $title = config('title');

        $path = $request->get('path');
         
        if($path){
            $this->insertLocation($path);
        } 

        $explodedQuery = array_filter(explode('/', str_replace('-',' ',$path)));

        $pageMeta = ucwords(implode(', ', $explodedQuery));

        $explodedQuery  = implode(' ',$explodedQuery);

        $explodedQuery = implode('%',explode(' ',$explodedQuery));

        $pageMeta = ($pageMeta) ? $pageMeta.', ' : '';


        $allKeywords = Keyword::whereUniversal(Keyword::ACTIVE)
                       ->likeName($explodedQuery)
                       ->pluck('name')->map(function($names){
                             return ucwords($names);
                        })->implode(', ');
       
       $allKeywords = ($allKeywords) ? $allKeywords.', ' : '';

        return response()->json([
         'description' => $pageMeta.$description,
         'keywords' => $pageMeta.$allKeywords.$keywords,
         'title' => $pageMeta.$title,
        ]);
    }

    public function insertLocation($path){
        $ip = request()->ip();
        $data = ['path' => $path, 'ip' => $ip];
        $ifCount = Location::whereDate('created_at', Carbon::today())
                 ->where($data)->first();
        if($ifCount){
            $ifCount->increment('count');
        }else{
          $location_data = LocationLib::get($ip);
          $data['location_data'] = ($location_data) ? json_encode($location_data) : ''; 
          Location::create($data);
        }      
         
        return;
    }
}

