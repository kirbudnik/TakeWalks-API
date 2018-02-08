<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsDetailsTransaction
 * 
 * @property int $id
 * @property int $bookings_details_id
 * @property string $trans_number
 * @property \Carbon\Carbon $trans_datetime
 * @property float $local_amount
 * @property float $local_discount
 * @property float $local_usd_rate
 * @property float $usd_amount
 * @property string $exchange_from
 * @property string $exchange_to
 * @property float $exchange_rate
 * @property float $exchange_amount
 *
 * @package 
 */
class BookingsDetailsTransaction extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'bookings_details_id' => 'int',
		'local_amount' => 'float',
		'local_discount' => 'float',
		'local_usd_rate' => 'float',
		'usd_amount' => 'float',
		'exchange_rate' => 'float',
		'exchange_amount' => 'float'
	];

	protected $dates = [
		'trans_datetime'
	];

	protected $fillable = [
		'bookings_details_id',
		'trans_number',
		'trans_datetime',
		'local_amount',
		'local_discount',
		'local_usd_rate',
		'usd_amount',
		'exchange_from',
		'exchange_to',
		'exchange_rate',
		'exchange_amount'
	];
}
