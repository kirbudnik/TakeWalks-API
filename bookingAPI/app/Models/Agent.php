<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Agent
 * 
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $email_address
 * @property string $password
 * @property string $phone
 * @property string $phone_emergency
 * @property string $notes
 * @property string $status
 * @property string $reset_hash
 * @property \Carbon\Carbon $reset_datetime
 * @property float $average_sales
 * @property string $affiliations
 * @property string $accreditation
 * @property bool $is_admin
 * 
 * @property \Illuminate\Database\Eloquent\Collection $agents_addresses
 * @property \Illuminate\Database\Eloquent\Collection $agents_payments
 *
 * @package 
 */
class Agent extends Model
{
	public $timestamps = false;

	protected $casts = [
		'average_sales' => 'float',
		'is_admin' => 'bool'
	];

	protected $dates = [
		'reset_datetime'
	];

	protected $fillable = [
		'fname',
		'lname',
		'email_address',
		'password',
		'phone',
		'phone_emergency',
		'notes',
		'status',
		'reset_hash',
		'reset_datetime',
		'average_sales',
		'affiliations',
		'accreditation',
		'is_admin'
	];

//	public function agents_addresses()
//	{
//		return $this->hasMany(\\AgentsAddress::class, 'agents_id');
//	}
//
//	public function agents_payments()
//	{
//		return $this->hasMany(\\AgentsPayment::class, 'agents_id');
//	}
}
