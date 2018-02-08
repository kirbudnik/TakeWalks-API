<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsPromosDetail
 * 
 * @property int $id
 * @property int $bookings_id
 * @property int $promos_id
 * @property int $percentage
 *
 * @package 
 */
class BookingsPromosDetail extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'bookings_id' => 'int',
		'promos_id' => 'int',
		'percentage' => 'int'
	];

	protected $fillable = [
		'bookings_id',
		'promos_id',
		'percentage'
	];
}
