<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventsStage
 * 
 * @property int $id
 * @property int $events_id
 * @property \Carbon\Carbon $datetime
 * @property int $pax_max
 * @property int $stall
 * @property int $critical
 * @property bool $group
 * @property int $schedule
 * @property bool $private_booked_flag
 * @property int $package_id
 * @property int $pax_adults
 * @property int $pax_seniors
 * @property int $pax_students
 * @property int $pax_children
 * @property int $pax_infants
 * @property int $pax_total
 * @property float $adults_price
 * @property float $seniors_price
 * @property float $students_price
 * @property float $children_price
 * @property float $infants_price
 *
 * @package 
 */
class EventsStage extends Model
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'events_id' => 'int',
		'pax_max' => 'int',
		'stall' => 'int',
		'critical' => 'int',
		'group' => 'bool',
		'schedule' => 'int',
		'private_booked_flag' => 'bool',
		'package_id' => 'int',
		'pax_adults' => 'int',
		'pax_seniors' => 'int',
		'pax_students' => 'int',
		'pax_children' => 'int',
		'pax_infants' => 'int',
		'pax_total' => 'int',
		'adults_price' => 'float',
		'seniors_price' => 'float',
		'students_price' => 'float',
		'children_price' => 'float',
		'infants_price' => 'float'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'events_id',
		'datetime',
		'pax_max',
		'stall',
		'critical',
		'group',
		'schedule',
		'private_booked_flag',
		'package_id',
		'pax_adults',
		'pax_seniors',
		'pax_students',
		'pax_children',
		'pax_infants',
		'pax_total',
		'adults_price',
		'seniors_price',
		'students_price',
		'children_price',
		'infants_price'
	];
}
