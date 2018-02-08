<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsAge
 * 
 * @property int $id
 * @property string $description
 * @property int $age_from
 * @property int $age_to
 * @property string $name
 *
 * @package 
 */
class BookingsAge extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'age_from' => 'int',
		'age_to' => 'int'
	];

	protected $fillable = [
		'description',
		'age_from',
		'age_to',
		'name'
	];
}
