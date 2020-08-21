<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Branch;


class MetaController extends Controller
{
    public function get(Request $request)
    {
        $description = config('description');
        $keywords = config('keywords');
        $title = config('title');

        $path = $request->get('path');

        $pageMeta = ucwords(implode(', ', array_filter(explode('/', str_replace('-',' ',$path)))));

        $pageMeta = ($pageMeta) ? $pageMeta.', ' : '';

        return response()->json([
         'description' => $pageMeta.$description,
         'keywords' => $pageMeta.$keywords,
         'title' => $pageMeta.$title,
        ]);
    }
}
