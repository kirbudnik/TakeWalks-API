<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsSpecialPrice
 * 
 * @property int $id
 * @property int $events_id
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property float $adults_price
 * @property float $seniors_price
 * @property float $students_price
 * @property float $children_price
 * @property float $infants_price
 * @property string $name
 *
 * @package 
 */
class EventsSpecialPrice extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'adults_price' => 'float',
		'seniors_price' => 'float',
		'students_price' => 'float',
		'children_price' => 'float',
		'infants_price' => 'float'
	];

	protected $dates = [
		'date_start',
		'date_end'
	];

	protected $fillable = [
		'events_id',
		'date_start',
		'date_end',
		'adults_price',
		'seniors_price',
		'students_price',
		'children_price',
		'infants_price',
		'name'
	];
}
