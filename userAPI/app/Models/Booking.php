<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 * 
 * @property int $id
 * @property int $clients_id
 * @property float $amount_local
 * @property int $currencies_id
 * @property float $amount_merchant
 * @property int $bookings_mediums_id
 * @property int $agents_id
 * @property string $clients_comments
 * @property float $amount_merchant_refunded
 * @property \Carbon\Carbon $booking_time
 * @property int $notifications_count
 * @property bool $is_archived
 * @property bool $has_comments
 * @property int $imported_id
 *
 * @package 
 */
class Booking extends Model
{
	public $timestamps = false;

	protected $casts = [
		'clients_id' => 'int',
		'amount_local' => 'float',
		'currencies_id' => 'int',
		'amount_merchant' => 'float',
		'bookings_mediums_id' => 'int',
		'agents_id' => 'int',
		'amount_merchant_refunded' => 'float',
		'notifications_count' => 'int',
		'is_archived' => 'bool',
		'has_comments' => 'bool',
		'imported_id' => 'int'
	];

	protected $dates = [
		'booking_time'
	];

	protected $fillable = [
		'clients_id',
		'amount_local',
		'currencies_id',
		'amount_merchant',
		'bookings_mediums_id',
		'agents_id',
		'clients_comments',
		'amount_merchant_refunded',
		'booking_time',
		'notifications_count',
		'is_archived',
		'has_comments',
		'imported_id'
	];
}
