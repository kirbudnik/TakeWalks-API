<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Equipment
 * 
 * @property int $id
 * @property string $name
 *
 * @package 
 */
class Equipment extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}
