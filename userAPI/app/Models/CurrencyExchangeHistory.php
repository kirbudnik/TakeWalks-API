<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class CurrencyExchangeHistory
 * 
 * @property int $id
 * @property string $exchangepair
 * @property float $rate
 * @property string $buffer
 * @property string $adj_rate
 * @property string $vendor_timestamp
 * @property \Carbon\Carbon $timestamp
 *
 * @package 
 */
class CurrencyExchangeHistory extends Eloquent
{
	protected $table = 'currency_exchange_history';
	public $timestamps = false;

	protected $casts = [
		'rate' => 'float'
	];

	protected $dates = [
		'timestamp'
	];

	protected $fillable = [
		'exchangepair',
		'rate',
		'buffer',
		'adj_rate',
		'vendor_timestamp',
		'timestamp'
	];
}
