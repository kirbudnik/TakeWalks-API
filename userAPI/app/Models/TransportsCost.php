<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class TransportsCost
 * 
 * @property int $id
 * @property int $transports_id
 * @property int $events_id
 * @property int $pax_min
 * @property int $pax_max
 * @property float $cost
 * @property float $price
 * @property string $description
 *
 * @package 
 */
class TransportsCost extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'transports_id' => 'int',
		'events_id' => 'int',
		'pax_min' => 'int',
		'pax_max' => 'int',
		'cost' => 'float',
		'price' => 'float'
	];

	protected $fillable = [
		'transports_id',
		'events_id',
		'pax_min',
		'pax_max',
		'cost',
		'price',
		'description'
	];
}
