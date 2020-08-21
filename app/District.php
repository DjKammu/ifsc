<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	protected $fillable = [
     'name','slug','state_id'
    ];

    public function state(){
    	return $this->belongsTo(State::class);
    }

    public function cities(){
    	return $this->hasMany(City::class);
    }
}
