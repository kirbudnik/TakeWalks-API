<?php

/**
 * Created by Release Model.
 * Date: Thu, 23 Jan 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingsDetailsExchangeRate
 * 
 * @property int $id
 * @property int $bookings_details_id
 * @property float $currency
 * @property float $amount
 * @property float $rate
 *
 * @package 
 */
class EventsStagePaxRemaining extends Model
{
	public $timestamps = false;

	protected $casts = [
		'bookings_details_id' => 'int',
		'currency' => 'float',
		'amount' => 'float',
		'rate' => 'float',		
	];

	protected $fillable = [
		'bookings_details_id',
		'currency',
		'amount',
		'rate',
	];
}
