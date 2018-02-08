<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsPromosType
 * 
 * @property int $id
 * @property string $name
 *
 * @package 
 */
class BookingsPromosType extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}
