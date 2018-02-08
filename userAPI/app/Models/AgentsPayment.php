<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class AgentsPayment
 * 
 * @property int $id
 * @property int $users_id
 * @property int $agents_id
 * @property string $check_number
 * @property float $usd_amount
 * @property string $notes
 * @property \Carbon\Carbon $travel_date
 * @property \Carbon\Carbon $create_date
 * 
 * @property \\Agent $agent
 *
 * @package 
 */
class AgentsPayment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'agents_id' => 'int',
		'usd_amount' => 'float'
	];

	protected $dates = [
		'travel_date',
		'create_date'
	];

	protected $fillable = [
		'users_id',
		'agents_id',
		'check_number',
		'usd_amount',
		'notes',
		'travel_date',
		'create_date'
	];

	public function agent()
	{
		return $this->belongsTo(\\Agent::class, 'agents_id');
	}
}
