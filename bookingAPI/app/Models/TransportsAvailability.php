<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class TransportsAvailability
 * 
 * @property int $id
 * @property int $transports_id
 * @property int $duration
 * @property \Carbon\Carbon $datetime
 *
 * @package 
 */
class TransportsAvailability extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'transports_id' => 'int',
		'duration' => 'int'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'transports_id',
		'duration',
		'datetime'
	];
}
