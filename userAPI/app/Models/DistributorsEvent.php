<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class DistributorsEvent
 * 
 * @property int $id
 * @property int $events_id
 * @property int $distributors_id
 * @property string $distributor_code
 * @property float $adult_price
 * @property float $child_price
 * @property string $distributor_product_code
 * @property int $event_depends_on_event_id
 * @property string $package_events_id
 * @property string $distributor_event_optional_code
 * @property string $distributor_event_optional_title
 * @property string $distributor_event_optional_description
 * @property string $distributor_event_optional_note
 * @property string $event_times_list
 * @property string $time_of_the_day
 * @property string $event_times_list_since_timestamp
 * @property string $event_times_list_future
 *
 * @package 
 */
class DistributorsEvent extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'distributors_id' => 'int',
		'adult_price' => 'float',
		'child_price' => 'float',
		'event_depends_on_event_id' => 'int'
	];

	protected $fillable = [
		'events_id',
		'distributors_id',
		'distributor_code',
		'adult_price',
		'child_price',
		'distributor_product_code',
		'event_depends_on_event_id',
		'package_events_id',
		'distributor_event_optional_code',
		'distributor_event_optional_title',
		'distributor_event_optional_description',
		'distributor_event_optional_note',
		'event_times_list',
		'time_of_the_day',
		'event_times_list_since_timestamp',
		'event_times_list_future'
	];
}
