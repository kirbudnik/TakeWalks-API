<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $country
 * @property string $ccode
 *
 * @package 
 */
class Country extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'country',
		'ccode'
	];
}
