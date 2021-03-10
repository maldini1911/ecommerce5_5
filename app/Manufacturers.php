<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{
    protected $table = 'manufacturers';
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
    ];
}
          
               