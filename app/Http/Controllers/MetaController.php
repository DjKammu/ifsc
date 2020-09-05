<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Branch;
use App\Keyword;


class MetaController extends Controller
{
    public function get(Request $request)
    {
        $description = config('description');
        $keywords = config('keywords');
        $title = config('title');

        $path = $request->get('path');

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
}
