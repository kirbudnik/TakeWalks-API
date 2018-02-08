<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesEquipment
 * 
 * @property int $id
 * @property int $stage_id
 * @property int $events_id
 * @property \Carbon\Carbon $events_datetime
 * @property int $equipments_id
 * @property int $status
 * @property \Carbon\Carbon $requested_datetime
 * @property \Carbon\Carbon $confirmed_datetime
 * @property int $equipment_providers_id
 * @property int $qty
 * @property string $confirmation
 * @property float $price_unit
 * @property float $price_hr
 * @property int $equipment_equipment_providers_id
 *
 * @package 
 */
class EventsStagesEquipment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'stage_id' => 'int',
		'events_id' => 'int',
		'equipments_id' => 'int',
		'status' => 'int',
		'equipment_providers_id' => 'int',
		'qty' => 'int',
		'price_unit' => 'float',
		'price_hr' => 'float',
		'equipment_equipment_providers_id' => 'int'
	];

	protected $dates = [
		'events_datetime',
		'requested_datetime',
		'confirmed_datetime'
	];

	protected $fillable = [
		'stage_id',
		'events_id',
		'events_datetime',
		'equipments_id',
		'status',
		'requested_datetime',
		'confirmed_datetime',
		'equipment_providers_id',
		'qty',
		'confirmation',
		'price_unit',
		'price_hr',
		'equipment_equipment_providers_id'
	];
}
