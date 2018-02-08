<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsMerchant
 * 
 * @property int $id
 * @property string $merchant_name
 * @property string $account
 *
 * @package 
 */
class BookingsMerchant extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'merchant_name',
		'account'
	];
}
