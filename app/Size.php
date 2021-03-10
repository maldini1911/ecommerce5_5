<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    protected $fillable = [
        'name_en',
        'name_ar',
        'department_id',
        'is_public'      
    ];

    public function departments(){

        return $this->hasOne('App\Department', 'id', 'department_id');

    }
}
