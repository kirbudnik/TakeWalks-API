<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentTransaction
 * 
 * @property int $id
 * @property float $amount_local
 * @property string $payment_amount
 * @property string $currencies_id
 * @property \Carbon\Carbon $transaction_date
 * @property int $booking_id
 * @property string $merchant_trans_number
 * @property string $TxRefNum
 * @property string $merchants_id
 * @property string $merchant_result
 * @property string $payment_status
 * @property int $clients_id
 * @property float $exchange_rate
 * @property string $exchange_from
 * @property string $exchange_to
 *
 * @package 
 */
class PaymentTransaction extends Model
{
	public $timestamps = false;

	protected $casts = [
		'amount_local' => 'float',
		'booking_id' => 'int',
		'clients_id' => 'int',
		'exchange_rate' => 'float'
	];

	protected $dates = [
		'transaction_date'
	];

	protected $fillable = [
		'amount_local',
		'payment_amount',
		'currencies_id',
		'transaction_date',
		'booking_id',
		'merchant_trans_number',
		'TxRefNum',
		'merchants_id',
		'merchant_result',
		'payment_status',
		'clients_id',
		'exchange_rate',
		'exchange_from',
		'exchange_to'
	];
}
