<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsGroupsType
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @package 
 */
class EventsGroupsType extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description'
	];
}
