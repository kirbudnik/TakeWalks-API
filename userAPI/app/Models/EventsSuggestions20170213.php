<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsSuggestions20170213
 * 
 * @property int $id
 * @property int $events_id
 * @property int $suggest_id
 * @property int $order
 *
 * @package 
 */
class EventsSuggestions20170213 extends Eloquent
{
	protected $table = 'events_suggestions20170213';
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'suggest_id' => 'int',
		'order' => 'int'
	];

	protected $fillable = [
		'events_id',
		'suggest_id',
		'order'
	];
}
