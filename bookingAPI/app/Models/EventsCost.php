<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsCost
 * 
 * @property int $id
 * @property string $gp
 * @property int $events_id
 * @property int $type_id
 * @property \Carbon\Carbon $from_date
 * @property \Carbon\Carbon $to_date
 * @property string $name
 * @property float $runningcost
 * @property float $groupcost
 * @property float $adult
 * @property float $senior
 * @property float $student
 * @property float $child
 * @property float $infant
 *
 * @package 
 */
class EventsCost extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'type_id' => 'int',
		'runningcost' => 'float',
		'groupcost' => 'float',
		'adult' => 'float',
		'senior' => 'float',
		'student' => 'float',
		'child' => 'float',
		'infant' => 'float'
	];

	protected $dates = [
		'from_date',
		'to_date'
	];

	protected $fillable = [
		'gp',
		'events_id',
		'type_id',
		'from_date',
		'to_date',
		'name',
		'runningcost',
		'groupcost',
		'adult',
		'senior',
		'student',
		'child',
		'infant'
	];
}
