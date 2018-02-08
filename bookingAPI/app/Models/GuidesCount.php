<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesCount
 * 
 * @property int $id
 * @property int $events_id
 * @property \Carbon\Carbon $datetime
 * @property int $guides_needed
 * @property int $guides_assigned
 * @property int $guides_pending
 * @property int $guides_requested
 * @property int $pax_adults
 * @property int $pax_seniors
 * @property int $pax_students
 * @property int $pax_children
 * @property int $pax_infants
 * @property int $pax_total
 *
 * @package 
 */
class GuidesCount extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'events_id' => 'int',
		'guides_needed' => 'int',
		'guides_assigned' => 'int',
		'guides_pending' => 'int',
		'guides_requested' => 'int',
		'pax_adults' => 'int',
		'pax_seniors' => 'int',
		'pax_students' => 'int',
		'pax_children' => 'int',
		'pax_infants' => 'int',
		'pax_total' => 'int'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'id',
		'events_id',
		'datetime',
		'guides_needed',
		'guides_assigned',
		'guides_pending',
		'guides_requested',
		'pax_adults',
		'pax_seniors',
		'pax_students',
		'pax_children',
		'pax_infants',
		'pax_total'
	];
}
