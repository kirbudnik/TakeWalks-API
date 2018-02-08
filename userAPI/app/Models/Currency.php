<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string $currency_name
 * @property string $currency_symbol
 *
 * @package 
 */
class Currency extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'currency_name',
		'currency_symbol'
	];
}
