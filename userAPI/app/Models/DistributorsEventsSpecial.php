<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class DistributorsEventsSpecial
 * 
 * @property int $id
 * @property int $events_id
 * @property int $distributors_id
 * @property \Carbon\Carbon $from_date
 * @property \Carbon\Carbon $to_date
 * @property float $adult_price
 * @property float $child_price
 *
 * @package 
 */
class DistributorsEventsSpecial extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'distributors_id' => 'int',
		'adult_price' => 'float',
		'child_price' => 'float'
	];

	protected $dates = [
		'from_date',
		'to_date'
	];

	protected $fillable = [
		'events_id',
		'distributors_id',
		'from_date',
		'to_date',
		'adult_price',
		'child_price'
	];
}
