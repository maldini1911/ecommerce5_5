<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primary_key = 'id';
    protected $fillable = [
        'title',
        'content',
        'photo',
        'department_id',
        'trade_id',
        'manu_id',
        'color_id',
        'size_id',
        'weight_id',
        'weight',
        'currency_id',
        'price',
        'start_at',
        'end_at',
        'start_offer_at',
        'end_offer_at',
        'price_offer',
        'other_data',
        'stock',
        'status',
        'reason',
    ];


    public function files(){

        return $this->hasMany('App\File', 'relation_id', 'id')->where('file_type', 'product');
    }

    public function other_data(){

        return $this->hasMany('App\otherData', 'product_id', 'id');
    }

    public function malls(){

        return $this->hasMany('App\MallProduct', 'product_id', 'id');
    }

}
