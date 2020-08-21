<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $fillable = [
     'name','slug','state_id','district_id'
    ];

    public function district(){
    	return $this->belongsTo(District::class);
    }

    public function state(){
    	return $this->belongsTo(State::class);
    }
}
