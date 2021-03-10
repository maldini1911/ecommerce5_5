<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'weights';
    protected $primary_key = 'id';
    protected $fillable = ['name_ar', 'name_en'];
}
