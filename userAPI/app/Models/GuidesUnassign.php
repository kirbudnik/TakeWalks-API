<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesUnassign
 * 
 * @property int $id
 * @property int $stage_id
 * @property int $guides_id
 * @property int $users_id
 * @property int $guide_status
 * @property \Carbon\Carbon $datetime
 * @property int $guide_denied
 * @property \Carbon\Carbon $requested_datetime
 * @property \Carbon\Carbon $confirmed_datetime
 *
 * @package 
 */
class GuidesUnassign extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'stage_id' => 'int',
		'guides_id' => 'int',
		'users_id' => 'int',
		'guide_status' => 'int',
		'guide_denied' => 'int'
	];

	protected $dates = [
		'datetime',
		'requested_datetime',
		'confirmed_datetime'
	];

	protected $fillable = [
		'stage_id',
		'guides_id',
		'users_id',
		'guide_status',
		'datetime',
		'guide_denied',
		'requested_datetime',
		'confirmed_datetime'
	];
}
