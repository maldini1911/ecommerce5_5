<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{

    protected $table = "Cities";
    protected $fillable = [
        'city_name_ar',
        'city_name_en',
        'country_id'
    ];

    public function country_id(){

        return $this->hasOne('App\Country', 'id', 'country_id');
    }
}
