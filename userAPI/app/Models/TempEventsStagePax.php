<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class TempEventsStagePax
 * 
 * @property int $number_adults
 * @property int $number_children
 * @property int $number_seniors
 * @property int $number_students
 * @property int $number_infants
 * @property int $number_total
 * @property int $sid
 *
 * @package 
 */
class TempEventsStagePax extends Eloquent
{
	protected $table = 'temp_events_stage_pax';
	protected $primaryKey = 'sid';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'number_adults' => 'int',
		'number_children' => 'int',
		'number_seniors' => 'int',
		'number_students' => 'int',
		'number_infants' => 'int',
		'number_total' => 'int',
		'sid' => 'int'
	];

	protected $fillable = [
		'number_adults',
		'number_children',
		'number_seniors',
		'number_students',
		'number_infants',
		'number_total'
	];
}
