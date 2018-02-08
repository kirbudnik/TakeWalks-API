<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class CharitiesDonation
 * 
 * @property int $id
 * @property int $charity_id
 * @property float $amount_local
 * @property int $booking_id
 * @property string $first_name
 * @property \Carbon\Carbon $created
 * @property float $exchange_rate
 * @property float $charged_usd_amount
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 *
 * @package 
 */
class CharitiesDonation extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'charity_id' => 'int',
		'amount_local' => 'float',
		'booking_id' => 'int',
		'exchange_rate' => 'float',
		'charged_usd_amount' => 'float'
	];

	protected $dates = [
		'created'
	];

	protected $fillable = [
		'charity_id',
		'amount_local',
		'booking_id',
		'first_name',
		'created',
		'exchange_rate',
		'charged_usd_amount',
		'last_name',
		'email',
		'phone',
		'address',
		'city',
		'state',
		'postal_code',
		'country'
	];
}
