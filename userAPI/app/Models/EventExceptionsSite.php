<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventExceptionsSite
 * 
 * @property int $id
 * @property int $sites_id
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property bool $action
 * @property string $notes
 *
 * @package 
 */
class EventExceptionsSite extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'sites_id' => 'int',
		'action' => 'bool'
	];

	protected $dates = [
		'date_start',
		'date_end'
	];

	protected $fillable = [
		'sites_id',
		'date_start',
		'date_end',
		'action',
		'notes'
	];
}
