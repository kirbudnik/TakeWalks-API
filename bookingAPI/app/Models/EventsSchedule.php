<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsSchedule
 * 
 * @property int $id
 * @property int $events_id
 * @property int $gp
 * @property int $orderby
 * @property \Carbon\Carbon $time
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property int $pax_max
 * @property int $stall
 * @property int $critical
 * @property float $adults_price
 * @property float $seniors_price
 * @property float $students_price
 * @property float $children_price
 * @property float $infants_price
 * @property int $repeat
 * @property int $repeat_every
 * @property bool $sunday
 * @property bool $monday
 * @property bool $tuesday
 * @property bool $wednesday
 * @property bool $thursday
 * @property bool $friday
 * @property bool $saturday
 * @property int $monthly_repeat
 * @property string $name
 * @property bool $active
 * @property bool $pending
 * @property int $add_remove
 * @property bool $remove_all_day
 * @property \Carbon\Carbon $time_end
 * @property int $time_interval
 * @property int $events_schedules_autos_id
 * @property \Carbon\Carbon $createdate
 * @property int $user_id
 * @property string $why
 *
 * @package 
 */
class EventsSchedule extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'gp' => 'int',
		'orderby' => 'int',
		'pax_max' => 'int',
		'stall' => 'int',
		'critical' => 'int',
		'adults_price' => 'float',
		'seniors_price' => 'float',
		'students_price' => 'float',
		'children_price' => 'float',
		'infants_price' => 'float',
		'repeat' => 'int',
		'repeat_every' => 'int',
		'sunday' => 'bool',
		'monday' => 'bool',
		'tuesday' => 'bool',
		'wednesday' => 'bool',
		'thursday' => 'bool',
		'friday' => 'bool',
		'saturday' => 'bool',
		'monthly_repeat' => 'int',
		'active' => 'bool',
		'pending' => 'bool',
		'add_remove' => 'int',
		'remove_all_day' => 'bool',
		'time_interval' => 'int',
		'events_schedules_autos_id' => 'int',
		'user_id' => 'int'
	];

	protected $dates = [
		'time',
		'date_start',
		'date_end',
		'time_end',
		'createdate'
	];

	protected $fillable = [
		'events_id',
		'gp',
		'orderby',
		'time',
		'date_start',
		'date_end',
		'pax_max',
		'stall',
		'critical',
		'adults_price',
		'seniors_price',
		'students_price',
		'children_price',
		'infants_price',
		'repeat',
		'repeat_every',
		'sunday',
		'monday',
		'tuesday',
		'wednesday',
		'thursday',
		'friday',
		'saturday',
		'monthly_repeat',
		'name',
		'active',
		'pending',
		'add_remove',
		'remove_all_day',
		'time_end',
		'time_interval',
		'events_schedules_autos_id',
		'createdate',
		'user_id',
		'why'
	];
}
