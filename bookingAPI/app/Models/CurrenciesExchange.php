<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class CurrenciesExchange
 * 
 * @property int $id
 * @property string $exchangepair
 * @property float $rate
 * @property string $buffer
 * @property string $adj_rate
 * @property string $vendor_timestamp
 * @property \Carbon\Carbon $last_update_timestamp
 *
 * @package 
 */
class CurrenciesExchange extends Model
{
	public $timestamps = false;

	protected $casts = [
		'rate' => 'float'
	];

	protected $dates = [
		'last_update_timestamp'
	];

	protected $fillable = [
		'exchangepair',
		'rate',
		'buffer',
		'adj_rate',
		'vendor_timestamp',
		'last_update_timestamp'
	];
}
