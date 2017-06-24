<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsModel extends Model
{
	protected $table = "cars";

	protected $primaryKey = 'id_car';

	public $timestamps = false;
}
