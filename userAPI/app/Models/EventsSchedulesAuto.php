<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsSchedulesAuto
 * 
 * @property int $id
 * @property string $name
 * @property string $gp
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created
 *
 * @package 
 */
class EventsSchedulesAuto extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'date',
		'created'
	];

	protected $fillable = [
		'name',
		'gp',
		'date',
		'created'
	];
}
