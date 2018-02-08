<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesHeadset
 * 
 * @property int $id
 * @property int $stage_id
 * @property int $events_id
 * @property \Carbon\Carbon $events_datetime
 * @property int $qty
 * @property float $costs
 * @property string $full_half
 * @property string $confirmation
 * @property int $headsets_id
 * @property int $stagegroup
 *
 * @package 
 */
class EventsStagesHeadset extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'stage_id' => 'int',
		'events_id' => 'int',
		'qty' => 'int',
		'costs' => 'float',
		'headsets_id' => 'int',
		'stagegroup' => 'int'
	];

	protected $dates = [
		'events_datetime'
	];

	protected $fillable = [
		'stage_id',
		'events_id',
		'events_datetime',
		'qty',
		'costs',
		'full_half',
		'confirmation',
		'headsets_id',
		'stagegroup'
	];
}
