<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesType
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $events_guides_costs_field
 *
 * @package 
 */
class GuidesType extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'events_guides_costs_field'
	];
}
