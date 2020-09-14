<?php
namespace App\Helpers;

use Illuminate\Support\Str;
use App\Keyword;
use Carbon\Carbon;

class GetIFSC {
  
  const TITLE_LENGTH = 1000;

  const DESCRIPTION_LENGTH = 2000;

  public static function getSEOTags()
  { 
        $path = str_replace(url('/'),'',request()->url());

        // $last = empty($uri) ? 'home' : last($uri);
        // $seoTags = ($page = Page::where('slug', $last)->first()) ? $page : 
                   // Lyrichord::where('slug', $uri)->first();

        $description = config('description');
        $keywords = config('keywords');
        $title = config('title');
        

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

         $seoTags = (object) [];

         $seoTags->meta_description = $description; 
         $seoTags->meta_keywords = $keywords;
         $seoTags->title = $title; 


        @$seoTags->meta_keywords = @$pageMeta.$allKeywords.@$seoTags->meta_keywords; 
        @$seoTags->meta_description = @$pageMeta.@$seoTags->meta_description; 
        @$seoTags->title = ucwords(\Str::lower(@$pageMeta.@$seoTags->title)).' | '.env("APP_NAME", "GetyourIFSC"); 

        $html = '';
        $html .= '<title>'.trim($seoTags->title).'</title>'."\n";
        $html .= '<meta name="title" 
        content="'.Str::substr(trim($seoTags->title), 0, self::TITLE_LENGTH).'">'."\n";
        $html .= '<meta name="description" content="'.Str::substr(trim(str_replace(array("\r","\n"),"",$seoTags->meta_description)), 0, self::DESCRIPTION_LENGTH).'">'."\n";
        $html .= '<meta name="keywords" content="'.trim($seoTags->meta_keywords).'">'."\n";
        return $html;
   }

   public static function count()
  {
        $uri = request()->segments();
        $uri = empty($uri) ? 'home' : last($uri);
        $lyrichord = Lyrichord::where('slug', $uri)->first();

        if(!$lyrichord){
            return;
        }
        $lc_id = $lyrichord->id;
        $ip = request()->ip();
        $data = ['lc_id' => $lc_id, 'ip' => $ip];
        $ifCount = LyrichordsCount::whereDate('created_at', Carbon::today())
                 ->where($data)->first();
        if($ifCount){
            $ifCount->increment('count');
        }else{
          $location_data = Location::get($ip);
          $data['location_data'] = ($location_data) ? json_encode($location_data) : ''; 
          LyrichordsCount::create($data);
        }      
         
        return; 
   }

   public static function chords(){
     
     $chords = [
      'A','Am','Ab','Abm','A#','A#m',
      'B','Bm','Bb','Bbm','B#','B#m',
      'C','Cm','Cb','Cbm','C#','C#m',
      'D','Dm','Db','Dbm','D#','D#m',
      'E','Em','Eb','Ebm',
      'F','Fm','F#','F#m','F#','F#m',
      'G','Gm','Gb','Gbm','G#','G#m',
      'U','Minor','Major'
     ];

     return json_encode($chords);

   }

   public static function croppedImage($image){

     $croppedImage = str_replace('.','-cropped.',$image);

     if (Storage::disk(config('voyager.storage.disk'))->exists($croppedImage)) {
          return \Voyager::image($croppedImage);
     }
      
     $croppedImage = str_replace('.','-cropped',$image);

     if (Storage::disk(config('voyager.storage.disk'))->exists($croppedImage)) {
          return \Voyager::image($croppedImage);
     }
      
     return \Voyager::image($image);

     }

     public static function cropImage($image){


        $croppedImage = str_replace('.','-cropped.',$image);

        if (Storage::disk(config('voyager.storage.disk'))->exists($croppedImage)) {
          return ;
        }

        $oldCroppedImage = str_replace('.','-cropped',$image);
        
        if (!Storage::disk(config('voyager.storage.disk'))->exists($oldCroppedImage)) {
            
            if (env("APP_ENV") == 'local') {
                return ;
            }

            $crop_width = '300';
            $crop_height = '250';

            $extension = pathinfo($image, PATHINFO_EXTENSION);

            $cImage = InterventionImage::make(\Voyager::image($image))
                ->fit($crop_width, $crop_height)
                ->encode($extension, 75);

            Storage::disk(config('voyager.storage.disk'))->put(
                $croppedImage,
                (string) $cImage,
                'public'
            );
        }
        else{

        Storage::disk(config('voyager.storage.disk'))->move($oldCroppedImage, $croppedImage);
        }

        Storage::disk(config('voyager.storage.disk'))->delete($oldCroppedImage);
        
        return true;
     }


     public static function deleteImage($image,$files){

        $altImage = str_replace(['-cropped.','-cropped'],['.','.'],$image);
      
        if (in_array($altImage, $files)) {
          return ;
        }

        $altImage = str_replace('/','\\',$altImage);
        
        if (in_array($altImage, $files)) {
          return ;
        }


        Storage::disk(config('voyager.storage.disk'))->delete($image);
        
        return true;
     }

}