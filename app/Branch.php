<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
     'branch','slug','state_id','district_id',
     'bank_id','city_id','ifsc_code','address','phone'
    ];
    
    public function bank(){
        return $this->belongsTo(Bank::class);
    }
    
    public function state(){
    	return $this->belongsTo(State::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function city(){
    	return $this->belongsTo(City::class);
    }
}
