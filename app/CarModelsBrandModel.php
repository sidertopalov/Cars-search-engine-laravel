<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModelsBrandModel extends Model
{
	protected $table = "models_brand";

	protected $primaryKey = 'model';

	public $timestamps = false;
}
