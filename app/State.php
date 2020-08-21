<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $fillable = [
     'name','slug'
    ];
    
    public function districts(){
    	return $this->hasMany(District::class);
    }

    public function bank(){
    	return $this->belongsTo(Bank::class);
    }
}
