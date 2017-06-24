<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarBrandsModel extends Model
{
    protected $table = "car_brands";

    protected $primaryKey = 'brand';
    
    public $timestamps = false;
}
