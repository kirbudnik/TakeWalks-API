<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class SitesReservationsScenario
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $sites_id
 * @property bool $hidden
 *
 * @package 
 */
class SitesReservationsScenario extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'sites_id' => 'int',
		'hidden' => 'bool'
	];

	protected $fillable = [
		'name',
		'description',
		'sites_id',
		'hidden'
	];
}
