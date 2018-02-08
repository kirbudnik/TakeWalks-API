<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsEquipment
 * 
 * @property int $id
 * @property int $events_id
 * @property int $equipment_id
 *
 * @package 
 */
class EventsEquipment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'equipment_id' => 'int'
	];

	protected $fillable = [
		'events_id',
		'equipment_id'
	];
}
