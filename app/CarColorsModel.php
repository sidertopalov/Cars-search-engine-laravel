<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarColorsModel extends Model
{
	protected $table = "colors";

	protected $primaryKey = 'color';

	public $timestamps = false;
}
