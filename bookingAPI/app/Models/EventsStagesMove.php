<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesMove
 * 
 * @property int $id
 * @property string $stage_options
 * @property int $users_id
 * @property \Carbon\Carbon $datetime
 * @property string $client_note
 * @property string $optional_tours
 * @property string $move_reason
 *
 * @package 
 */
class EventsStagesMove extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'stage_options',
		'users_id',
		'datetime',
		'client_note',
		'optional_tours',
		'move_reason'
	];
}
