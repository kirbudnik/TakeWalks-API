<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesAvailability
 * 
 * @property int $id
 * @property int $guides_id
 * @property int $duration
 * @property \Carbon\Carbon $datetime
 * @property string $notes
 * @property int $refused_stage_id
 * @property int $repeat_id
 *
 * @package 
 */
class GuidesAvailability extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'guides_id' => 'int',
		'duration' => 'int',
		'refused_stage_id' => 'int',
		'repeat_id' => 'int'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'guides_id',
		'duration',
		'datetime',
		'notes',
		'refused_stage_id',
		'repeat_id'
	];
}
