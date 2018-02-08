<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class PackageEvent
 * 
 * @property int $id
 * @property int $packages_id
 * @property int $events_id
 * @property int $order_events
 *
 * @package 
 */
class PackageEvent extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'packages_id' => 'int',
		'events_id' => 'int',
		'order_events' => 'int'
	];

	protected $fillable = [
		'packages_id',
		'events_id',
		'order_events'
	];
}
