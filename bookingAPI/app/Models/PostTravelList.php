<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class PostTravelList
 * 
 * @property int $id
 * @property string $email
 * @property string $fname
 * @property string $lname
 * @property string $days_out
 * @property string $tour_date
 *
 * @package 
 */
class PostTravelList extends Eloquent
{
	protected $table = 'post_travel_list';
	public $timestamps = false;

	protected $fillable = [
		'email',
		'fname',
		'lname',
		'days_out',
		'tour_date'
	];
}
