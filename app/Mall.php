<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table = 'malls';
    protected $fillable = [
        'name_en',
        'name_ar',
        'contact_name',      
        'facebook',         
        'twitter',           
        'website',            
        'email',              
        'mobile',              
        'lat',                 
        'lng', 
        'icon',
        'country_id',
    ];

    public function countries(){

        return $this->hasOne('App\Country', 'id', 'country_id');
    }

    public function malls(){

        return $this->hasOne('App\Country', 'id', 'country_id');
    }

    public function mall_product(){

        return $this->hasMany('App\MallProduct', 'mall_id', 'id');
    }
}
