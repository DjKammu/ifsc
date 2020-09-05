<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    CONST YES = 'Yes';
    
    CONST NO = 'No';
    
    CONST ACTIVE = 1;


    public function scopeLikeName($query, $q)
	{  
	    $query->orWhere('name', 'LIKE', '%'.$q .'%');
	    return $query;
	}


}
