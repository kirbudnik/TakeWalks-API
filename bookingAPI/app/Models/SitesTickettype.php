<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class SitesTickettype
 * 
 * @property int $id
 * @property string $name
 * @property int $sites_id
 * @property int $type_id
 * @property int $scenario_id
 * @property int $paxMultiplier
 * @property bool $annulled
 * @property bool $has_pdf
 *
 * @package 
 */
class SitesTickettype extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'sites_id' => 'int',
		'type_id' => 'int',
		'scenario_id' => 'int',
		'paxMultiplier' => 'int',
		'annulled' => 'bool',
		'has_pdf' => 'bool'
	];

	protected $fillable = [
		'name',
		'sites_id',
		'type_id',
		'scenario_id',
		'paxMultiplier',
		'annulled',
		'has_pdf'
	];
}
