<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesDetail
 * 
 * @property int $id
 * @property int $events_id
 * @property \Carbon\Carbon $datetime
 * @property string $notes
 * @property int $stage_id
 * @property bool $share
 * @property string $guides_notes
 * @property bool $default_note
 * @property string $coordinator_notes
 * @property int $coordinator_report_status
 * @property bool $coordinator_report_issue
 * @property string $guides_snap
 * @property string $tickets_snap
 * @property string $transport_snap
 * @property string $headsets_snap
 * @property string $events_snap
 * @property string $clients_snap
 * @property \Carbon\Carbon $snap_timestamp
 * @property string $all_snap
 * @property \Carbon\Carbon $last_edit_timestamp
 * @property int $last_edit_user
 * @property int $stagegroup_number
 * @property string $custom_name
 *
 * @package 
 */
class EventsStagesDetail extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'stage_id' => 'int',
		'share' => 'bool',
		'default_note' => 'bool',
		'coordinator_report_status' => 'int',
		'coordinator_report_issue' => 'bool',
		'last_edit_user' => 'int',
		'stagegroup_number' => 'int'
	];

	protected $dates = [
		'datetime',
		'snap_timestamp',
		'last_edit_timestamp'
	];

	protected $fillable = [
		'events_id',
		'datetime',
		'notes',
		'stage_id',
		'share',
		'guides_notes',
		'default_note',
		'coordinator_notes',
		'coordinator_report_status',
		'coordinator_report_issue',
		'guides_snap',
		'tickets_snap',
		'transport_snap',
		'headsets_snap',
		'events_snap',
		'clients_snap',
		'snap_timestamp',
		'all_snap',
		'last_edit_timestamp',
		'last_edit_user',
		'stagegroup_number',
		'custom_name'
	];
}
