<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsDomainsGroup
 * 
 * @property int $id
 * @property int $group_id
 * @property int $event_id
 * @property bool $primary
 *
 * @package 
 */
class EventsDomainsGroup extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'group_id' => 'int',
		'event_id' => 'int',
		'primary' => 'bool'
	];

	protected $fillable = [
		'group_id',
		'event_id',
		'primary'
	];
}
