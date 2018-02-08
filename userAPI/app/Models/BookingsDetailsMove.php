<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsDetailsMove
 * 
 * @property int $id
 * @property int $bookings_details_id
 * @property int $clients_id
 * @property int $old_stage
 * @property int $new_stage
 * @property int $users_id
 * @property \Carbon\Carbon $datetime
 * @property int $events_stages_moves_id
 * @property int $clients_request_status
 * @property \Carbon\Carbon $last_updated
 * @property string $last_user_updated
 *
 * @package 
 */
class BookingsDetailsMove extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'bookings_details_id' => 'int',
		'clients_id' => 'int',
		'old_stage' => 'int',
		'new_stage' => 'int',
		'users_id' => 'int',
		'events_stages_moves_id' => 'int',
		'clients_request_status' => 'int'
	];

	protected $dates = [
		'datetime',
		'last_updated'
	];

	protected $fillable = [
		'bookings_details_id',
		'clients_id',
		'old_stage',
		'new_stage',
		'users_id',
		'datetime',
		'events_stages_moves_id',
		'clients_request_status',
		'last_updated',
		'last_user_updated'
	];
}
