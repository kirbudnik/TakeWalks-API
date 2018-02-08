<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsAddress
 * 
 * @property int $id
 * @property int $bookings_id
 * @property string $hotel_name
 * @property string $hotel_telephone
 * @property string $mobile_number
 * @property string $city
 * @property string $countries_id
 * @property string $staying_from
 * @property string $staying_to
 * @property string $arrival_by
 * @property string $arrival_time
 * @property string $arrival_details
 * @property string $hotel_address
 * @property string $departure_by
 * @property string $departure_time
 * @property string $departure_details
 * @property string $travel_mobile_number
 * @property string $travel_name
 * @property string $travel_email
 * @property int $domains_groups_id
 *
 * @package 
 */
class BookingsAddress extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'bookings_id' => 'int',
		'domains_groups_id' => 'int'
	];

	protected $fillable = [
		'bookings_id',
		'hotel_name',
		'hotel_telephone',
		'mobile_number',
		'city',
		'countries_id',
		'staying_from',
		'staying_to',
		'arrival_by',
		'arrival_time',
		'arrival_details',
		'hotel_address',
		'departure_by',
		'departure_time',
		'departure_details',
		'travel_mobile_number',
		'travel_name',
		'travel_email',
		'domains_groups_id'
	];
}
