<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Ticket
 * 
 * @property int $id
 * @property bool $cancel_ticket
 * @property int $cancel_who
 * @property \Carbon\Carbon $cancel_when
 * @property int $sites_id
 * @property \Carbon\Carbon $datetime
 * @property int $users_id
 * @property int $tickets_adults
 * @property int $tickets_children
 * @property int $tickets_seniors
 * @property int $tickets_students
 * @property int $tickets_infants
 * @property \Carbon\Carbon $ticket_datetime
 * @property string $reservation_code
 * @property string $voucher
 * @property int $events_id
 * @property \Carbon\Carbon $events_datetime
 * @property int $scenarios_id
 * @property int $stagegroup
 * @property int $stage_id
 * @property bool $group
 * @property string $import_uuid
 * @property float $import_cost
 *
 * @package 
 */
class Ticket extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cancel_ticket' => 'bool',
		'cancel_who' => 'int',
		'sites_id' => 'int',
		'users_id' => 'int',
		'tickets_adults' => 'int',
		'tickets_children' => 'int',
		'tickets_seniors' => 'int',
		'tickets_students' => 'int',
		'tickets_infants' => 'int',
		'events_id' => 'int',
		'scenarios_id' => 'int',
		'stagegroup' => 'int',
		'stage_id' => 'int',
		'group' => 'bool',
		'import_uuid' => 'binary',
		'import_cost' => 'float'
	];

	protected $dates = [
		'cancel_when',
		'datetime',
		'ticket_datetime',
		'events_datetime'
	];

	protected $fillable = [
		'cancel_ticket',
		'cancel_who',
		'cancel_when',
		'sites_id',
		'datetime',
		'users_id',
		'tickets_adults',
		'tickets_children',
		'tickets_seniors',
		'tickets_students',
		'tickets_infants',
		'ticket_datetime',
		'reservation_code',
		'voucher',
		'events_id',
		'events_datetime',
		'scenarios_id',
		'stagegroup',
		'stage_id',
		'group',
		'import_uuid',
		'import_cost'
	];
}
