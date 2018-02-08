<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesUrgentList
 * 
 * @property int $id
 * @property int $stage_id
 * @property int $events_id
 * @property \Carbon\Carbon $datetime
 *
 * @package 
 */
class GuidesUrgentList extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'stage_id' => 'int',
		'events_id' => 'int'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'stage_id',
		'events_id',
		'datetime'
	];
}
