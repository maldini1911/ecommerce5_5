<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';
    protected $fillable = [
        'name_en',
        'name_ar',
        'user_id',                  
        'lat',                 
        'lng', 
        'icon',
    ];


    public function users(){

        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
