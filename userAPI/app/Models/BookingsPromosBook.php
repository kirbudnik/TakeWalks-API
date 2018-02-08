<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsPromosBook
 * 
 * @property int $id
 * @property string $book_name
 * @property int $bookings_promos_id
 *
 * @package 
 */
class BookingsPromosBook extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'bookings_promos_id' => 'int'
	];

	protected $fillable = [
		'book_name',
		'bookings_promos_id'
	];
}
