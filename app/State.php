<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class State extends Model
{

    protected $table = "states";
    protected $fillable = [
        'state_name_ar',
        'state_name_en',
        'city_id',
        'country_id'
    ];

    public function city_id(){

        return $this->hasOne('App\City', 'id', 'city_id');
    }

    
    public function country_id(){

        return $this->hasOne('App\Country', 'id', 'country_id');
    }
}
