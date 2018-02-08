<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class AgentsAddress
 * 
 * @property int $id
 * @property int $agents_id
 * @property string $billing_address1
 * @property string $billing_address2
 * @property string $billing_city
 * @property string $billing_state
 * @property string $billing_zip
 * @property string $billing_country
 * @property string $agency_name
 * @property string $agent_address1
 * @property string $agent_address2
 * @property string $agent_city
 * @property string $agent_state
 * @property string $agent_zip
 * @property string $agent_country
 * 
 * @property \\Agent $agent
 *
 * @package 
 */
class AgentsAddress extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'agents_id' => 'int'
	];

	protected $fillable = [
		'agents_id',
		'billing_address1',
		'billing_address2',
		'billing_city',
		'billing_state',
		'billing_zip',
		'billing_country',
		'agency_name',
		'agent_address1',
		'agent_address2',
		'agent_city',
		'agent_state',
		'agent_zip',
		'agent_country'
	];

	public function agent()
	{
		return $this->belongsTo(\\Agent::class, 'agents_id');
	}
}
