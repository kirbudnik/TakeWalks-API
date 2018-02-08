<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesCoord
 * 
 * @property int $id
 * @property int $coords_id
 * @property int $stage_id
 * @property int $events_id
 * @property \Carbon\Carbon $events_datetimes
 *
 * @package 
 */
class EventsStagesCoord extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'coords_id' => 'int',
		'stage_id' => 'int',
		'events_id' => 'int'
	];

	protected $dates = [
		'events_datetimes'
	];

	protected $fillable = [
		'coords_id',
		'stage_id',
		'events_id',
		'events_datetimes'
	];
}
