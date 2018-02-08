<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesGuidesSwitch
 * 
 * @property int $id
 * @property int $event_id
 * @property int $stage_id
 * @property int $requesting_guide_id
 * @property int $receiving_guide_id
 * @property int $events_stages_guides_id
 * @property \Carbon\Carbon $request_datetime
 * @property \Carbon\Carbon $response_datetime
 * @property int $status
 * @property int $is_escort
 * @property int $guides_availabilities_id
 *
 * @package 
 */
class EventsStagesGuidesSwitch extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'event_id' => 'int',
		'stage_id' => 'int',
		'requesting_guide_id' => 'int',
		'receiving_guide_id' => 'int',
		'events_stages_guides_id' => 'int',
		'status' => 'int',
		'is_escort' => 'int',
		'guides_availabilities_id' => 'int'
	];

	protected $dates = [
		'request_datetime',
		'response_datetime'
	];

	protected $fillable = [
		'event_id',
		'stage_id',
		'requesting_guide_id',
		'receiving_guide_id',
		'events_stages_guides_id',
		'request_datetime',
		'response_datetime',
		'status',
		'is_escort',
		'guides_availabilities_id'
	];
}
