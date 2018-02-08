<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsPromosQuestion
 * 
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $bookings_promos_books_id
 *
 * @package 
 */
class BookingsPromosQuestion extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'bookings_promos_books_id' => 'int'
	];

	protected $fillable = [
		'question',
		'answer',
		'bookings_promos_books_id'
	];
}
