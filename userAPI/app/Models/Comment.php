<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Comment
 * 
 * @property int $id
 * @property string $comment_detail
 * @property \Carbon\Carbon $comment_time
 * @property int $booking_id
 * @property int $user_id
 * @property string $notes_type
 * @property int $payment_id
 * @property int $bookings_details_id
 *
 * @package 
 */
class Comment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'booking_id' => 'int',
		'user_id' => 'int',
		'payment_id' => 'int',
		'bookings_details_id' => 'int'
	];

	protected $dates = [
		'comment_time'
	];

	protected $fillable = [
		'comment_detail',
		'comment_time',
		'booking_id',
		'user_id',
		'notes_type',
		'payment_id',
		'bookings_details_id'
	];
}
