<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Snapfail
 * 
 * @property int $id
 * @property int $stage_id
 * @property \Carbon\Carbon $datetimes
 * @property string $old_value
 * @property string $new_value
 *
 * @package 
 */
class Snapfail extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'stage_id' => 'int'
	];

	protected $dates = [
		'datetimes'
	];

	protected $fillable = [
		'stage_id',
		'datetimes',
		'old_value',
		'new_value'
	];
}
