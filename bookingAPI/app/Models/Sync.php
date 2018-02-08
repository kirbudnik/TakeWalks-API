<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Sync
 * 
 * @property int $id
 * @property bool $successful
 * @property \Carbon\Carbon $timestamp
 * @property int $last_id
 * @property int $clients_inserted
 * @property int $bookings_inserted
 * @property int $details_inserted
 * @property int $addons_inserted
 *
 * @package 
 */
class Sync extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'successful' => 'bool',
		'last_id' => 'int',
		'clients_inserted' => 'int',
		'bookings_inserted' => 'int',
		'details_inserted' => 'int',
		'addons_inserted' => 'int'
	];

	protected $dates = [
		'timestamp'
	];

	protected $fillable = [
		'successful',
		'timestamp',
		'last_id',
		'clients_inserted',
		'bookings_inserted',
		'details_inserted',
		'addons_inserted'
	];
}
