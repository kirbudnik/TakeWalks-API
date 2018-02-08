<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesStage
 * 
 * @property int $id
 * @property int $stage_id
 * @property \Carbon\Carbon $datetime
 * @property int $duration
 * @property int $events_id
 * @property int $guide_id
 * @property \Carbon\Carbon $datetime_end
 * @property float $guide_cost
 *
 * @package 
 */
class GuidesStage extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'stage_id' => 'int',
		'duration' => 'int',
		'events_id' => 'int',
		'guide_id' => 'int',
		'guide_cost' => 'float'
	];

	protected $dates = [
		'datetime',
		'datetime_end'
	];

	protected $fillable = [
		'stage_id',
		'datetime',
		'duration',
		'events_id',
		'guide_id',
		'datetime_end',
		'guide_cost'
	];
}
