<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";
    protected $fillable = [
        'deb_name_ar',
        'deb_name_en',
        'icon',
        'description',
        'keyword',
        'parent'
    ];

    public function parnets(){

        return $this->hasMany('App\Department', 'id', 'parent');
    }
}
