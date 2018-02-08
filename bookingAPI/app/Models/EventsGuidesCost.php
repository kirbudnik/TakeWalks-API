<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsGuidesCost
 * 
 * @property int $id
 * @property int $events_id
 * @property float $escort_costs
 * @property float $unlicensed_costs
 * @property float $licensed_costs
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 *
 * @package 
 */
class EventsGuidesCost extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'escort_costs' => 'float',
		'unlicensed_costs' => 'float',
		'licensed_costs' => 'float'
	];

	protected $dates = [
		'start_date',
		'end_date'
	];

	protected $fillable = [
		'events_id',
		'escort_costs',
		'unlicensed_costs',
		'licensed_costs',
		'start_date',
		'end_date'
	];
}
