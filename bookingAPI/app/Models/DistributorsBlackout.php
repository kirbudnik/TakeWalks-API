<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class DistributorsBlackout
 * 
 * @property int $id
 * @property int $stage_id
 * @property int $users_id
 * @property \Carbon\Carbon $datetime
 *
 * @package 
 */
class DistributorsBlackout extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'stage_id' => 'int',
		'users_id' => 'int'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'stage_id',
		'users_id',
		'datetime'
	];
}
