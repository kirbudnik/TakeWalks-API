<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsReview
 * 
 * @property int $id
 * @property int $events_id
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $event_date
 * @property int $event_rating
 * @property string $feedback_text
 * @property \Carbon\Carbon $feedback_date
 *
 * @package 
 */
class EventsReview extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'event_rating' => 'int'
	];

	protected $dates = [
		'event_date',
		'feedback_date'
	];

	protected $fillable = [
		'events_id',
		'first_name',
		'last_name',
		'event_date',
		'event_rating',
		'feedback_text',
		'feedback_date'
	];
}
