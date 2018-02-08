<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesTransport
 * 
 * @property int $id
 * @property int $events_id
 * @property \Carbon\Carbon $events_datetime
 * @property int $transports_id
 * @property int $status
 * @property \Carbon\Carbon $requested_datetime
 * @property \Carbon\Carbon $confirmed_datetime
 * @property int $stage_id
 * @property string $notes
 * @property int $qty
 * @property float $costs
 * @property int $stagegroup
 *
 * @package 
 */
class EventsStagesTransport extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'transports_id' => 'int',
		'status' => 'int',
		'stage_id' => 'int',
		'qty' => 'int',
		'costs' => 'float',
		'stagegroup' => 'int'
	];

	protected $dates = [
		'events_datetime',
		'requested_datetime',
		'confirmed_datetime'
	];

	protected $fillable = [
		'events_id',
		'events_datetime',
		'transports_id',
		'status',
		'requested_datetime',
		'confirmed_datetime',
		'stage_id',
		'notes',
		'qty',
		'costs',
		'stagegroup'
	];
}
