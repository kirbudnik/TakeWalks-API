<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsTag
 * 
 * @property int $id
 * @property int $event_id
 * @property int $tag_id
 *
 * @package 
 */
class EventsTag extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'event_id' => 'int',
		'tag_id' => 'int'
	];

	protected $fillable = [
		'event_id',
		'tag_id'
	];
}
