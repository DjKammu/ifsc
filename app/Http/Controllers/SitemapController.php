<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Bank;


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

	public function pages(){
		return response()->view('sitemap.pages')->header('Content-Type', 'text/xml');
	}

	// public function lyrichord(Request $request,$slug = null)
	// {
	// 	$lyrichord = Lyrichord::where('slug', $slug)
	//           ->whereStatus(Lyrichord::PUBLISHED)
 //              ->first();      

	// 	return response()->view('sitemap.lyrichord', ['lyrichord' => $lyrichord,'slug' => $slug])
	// 	      ->header('Content-Type', 'text/xml');

	// }

	// public function tagsCateogries(Request $request,$tc)
 //    {
 //      $tcs = [];
 //      $tc = str_singular($tc);

 //      if(in_array($tc,[Lyrichord::TAG,Lyrichord::CATEGORY])){
 //            $model = ($tc == Lyrichord::TAG) ? "App\Tag" : "TCG\Voyager\Models\Category";
 //           $tcs = $model::get();
 //      }
 //       return response()->view('sitemap.tcs', ['tcs' => $tcs,'tc'=> $tc])
 //              ->header('Content-Type', 'text/xml');

 //   }

 //   public function tagCateogry(Request $request,$tc,$slug)
 //    {
 //      $lyrichords = [];

 //      if(in_array($tc,[Lyrichord::TAG,Lyrichord::CATEGORY])){
 //         $lyrichords = Lyrichord::whereHas(str_plural($tc), function ($query) use ($slug) {
 //                      $query->where('slug', $slug);
 //                  })->whereStatus(Lyrichord::PUBLISHED)
 //                  ->orderBy('id','DESC')
 //                  ->paginate(Lyrichord::PER_PAGE); 
 //      }
      
 //       return response()->view('sitemap.lyrichords', ['lyrichords' => $lyrichords,'slug' => $slug,'tc'=> $tc])->header('Content-Type', 'text/xml');

 //   }


 //   public function search(Request $request,$search)
 //    {
 //        $query = Lyrichord::select('lyrichords.*')
 //                 ->whereStatus(Lyrichord::PUBLISHED);

 //        $s = $search;
 //        $s = implode(' ',explode(',',$s));
 //        $s = implode('%',explode(' ',$s));

 //        $query->where(function($q) use ($s){

 //          $q->where("title","LIKE","%$s%");
 //          $q->orWhere("slug","LIKE","%$s%");
 //          $q->orWhere("content","LIKE","%$s%");
 //          $q->orWhere("lyrics","LIKE","%$s%");
 //          $q->orWhere("excerpt","LIKE","%$s%");
 //          $q->orWhere("seo_title","LIKE","%$s%");
 //          $q->orWhere("meta_description","LIKE","%$s%");
 //          $q->orWhere("meta_keywords","LIKE","%$s%");

 //          $q->orWhereHas('tags',function($qr) use($s){                
 //            $qr->where('name', "LIKE","%$s%");
 //            $qr->orWhere('slug', "LIKE","%$s%");               
 //         });

 //         $q->orWhereHas('categories',function($qr) use($s){                
 //              $qr->where('name', "LIKE","%$s%");
 //              $qr->orWhere('slug', "LIKE","%$s%");               
 //         });

 //        });  

 //        $lyrichords = $query->orderBy('lyrichords.id','DESC')
 //                     ->paginate(Lyrichord::PER_PAGE); 

 //       return response()->view('sitemap.lyrichords', ['lyrichords' => $lyrichords,'search' => $search])
 //             ->header('Content-Type', 'text/xml');

 //   }

}
