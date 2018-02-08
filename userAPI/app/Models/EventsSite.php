<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsSite
 * 
 * @property int $id
 * @property int $events_id
 * @property int $sites_id
 * @property int $order
 *
 * @package 
 */
class EventsSite extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'sites_id' => 'int',
		'order' => 'int'
	];

	protected $fillable = [
		'events_id',
		'sites_id',
		'order'
	];
}
