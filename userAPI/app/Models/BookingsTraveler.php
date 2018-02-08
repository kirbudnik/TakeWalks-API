<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsTraveler
 * 
 * @property int $id
 * @property int $clients_id
 * @property string $fname
 * @property string $lname
 * @property string $suffix
 * @property int $sex
 *
 * @package 
 */
class BookingsTraveler extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'clients_id' => 'int',
		'sex' => 'int'
	];

	protected $fillable = [
		'clients_id',
		'fname',
		'lname',
		'suffix',
		'sex'
	];
}
