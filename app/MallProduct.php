<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallProduct extends Model
{
    protected $table = 'mall_products';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'mall_id'];
}
