<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EquipmentEquipmentProvider
 * 
 * @property int $id
 * @property int $equipment_id
 * @property int $equipment_providers_id
 * @property float $price_hr
 * @property float $price_unit
 *
 * @package 
 */
class EquipmentEquipmentProvider extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'equipment_id' => 'int',
		'equipment_providers_id' => 'int',
		'price_hr' => 'float',
		'price_unit' => 'float'
	];

	protected $fillable = [
		'equipment_id',
		'equipment_providers_id',
		'price_hr',
		'price_unit'
	];
}
