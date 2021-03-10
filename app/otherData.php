<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class otherData extends Model
{
    protected $table = 'other_datas';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'input_key', 'input_value'];
}
