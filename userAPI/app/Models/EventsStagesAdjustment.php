<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesAdjustment
 * 
 * @property int $id
 * @property int $stage_id
 * @property int $type_id
 * @property float $value
 * @property int $users_id
 * @property \Carbon\Carbon $datetime
 * @property string $name
 *
 * @package 
 */
class EventsStagesAdjustment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'stage_id' => 'int',
		'type_id' => 'int',
		'value' => 'float',
		'users_id' => 'int'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'stage_id',
		'type_id',
		'value',
		'users_id',
		'datetime',
		'name'
	];
}
