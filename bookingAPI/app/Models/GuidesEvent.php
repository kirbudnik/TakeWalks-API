<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesEvent
 * 
 * @property int $id
 * @property int $guides_id
 * @property int $events_id
 *
 * @package 
 */
class GuidesEvent extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'guides_id' => 'int',
		'events_id' => 'int'
	];

	protected $fillable = [
		'guides_id',
		'events_id'
	];
}
