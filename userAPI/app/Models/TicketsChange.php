<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class TicketsChange
 * 
 * @property int $id
 * @property \Carbon\Carbon $when
 * @property int $users_id
 * @property int $tickets_id
 * @property string $ticketData
 *
 * @package 
 */
class TicketsChange extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'tickets_id' => 'int'
	];

	protected $dates = [
		'when'
	];

	protected $fillable = [
		'when',
		'users_id',
		'tickets_id',
		'ticketData'
	];
}
