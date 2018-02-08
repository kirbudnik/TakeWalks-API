<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class TransportsEvent
 * 
 * @property int $id
 * @property int $transports_id
 * @property int $events_id
 *
 * @package 
 */
class TransportsEvent extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'transports_id' => 'int',
		'events_id' => 'int'
	];

	protected $fillable = [
		'transports_id',
		'events_id'
	];
}
