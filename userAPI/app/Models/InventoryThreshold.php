<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class InventoryThreshold
 * 
 * @property int $id
 * @property int $events_id
 * @property int $days_out
 * @property int $percent_full
 *
 * @package 
 */
class InventoryThreshold extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'days_out' => 'int',
		'percent_full' => 'int'
	];

	protected $fillable = [
		'events_id',
		'days_out',
		'percent_full'
	];
}
