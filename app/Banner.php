<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
     protected $fillable = [
		     'name','image'
      ];

     public function banks(){

    	return $this->belongsToMany(Bank::class)->withTimestamps();
    }
}
