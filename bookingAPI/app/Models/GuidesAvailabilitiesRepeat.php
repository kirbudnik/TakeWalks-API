<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesAvailabilitiesRepeat
 * 
 * @property int $id
 * @property int $guides_id
 * @property string $name
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property \Carbon\Carbon $time
 * @property int $duration
 * @property bool $sunday
 * @property bool $monday
 * @property bool $tuesday
 * @property bool $wednesday
 * @property bool $thursday
 * @property bool $friday
 * @property bool $saturday
 *
 * @package 
 */
class GuidesAvailabilitiesRepeat extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'guides_id' => 'int',
		'duration' => 'int',
		'sunday' => 'bool',
		'monday' => 'bool',
		'tuesday' => 'bool',
		'wednesday' => 'bool',
		'thursday' => 'bool',
		'friday' => 'bool',
		'saturday' => 'bool'
	];

	protected $dates = [
		'date_start',
		'date_end',
		'time'
	];

	protected $fillable = [
		'guides_id',
		'name',
		'date_start',
		'date_end',
		'time',
		'duration',
		'sunday',
		'monday',
		'tuesday',
		'wednesday',
		'thursday',
		'friday',
		'saturday'
	];
}
