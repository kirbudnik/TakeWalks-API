<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class TicketsExclude
 * 
 * @property int $id
 * @property string $uuid
 * @property \Carbon\Carbon $ticket_datetime
 * @property string $code
 *
 * @package 
 */
class TicketsExclude extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'uuid' => 'binary'
	];

	protected $dates = [
		'ticket_datetime'
	];

	protected $fillable = [
		'uuid',
		'ticket_datetime',
		'code'
	];
}
