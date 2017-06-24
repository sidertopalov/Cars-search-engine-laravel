<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarEnginesModel extends Model
{
	protected $table = "car_engines";

	protected $primaryKey = 'engines';

	public $timestamps = false;
}
