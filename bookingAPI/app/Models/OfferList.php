<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class OfferList
 * 
 * @property int $id
 * @property string $email
 * @property string $fname
 * @property string $lname
 * @property string $tour_city
 * @property string $tour_id
 * @property string $days_out
 * @property int $01_booked
 * @property int $02_booked
 * @property int $03_booked
 * @property int $04_booked
 * @property int $05_booked
 * @property int $06_booked
 * @property int $07_booked
 * @property int $08_booked
 * @property int $09_booked
 * @property int $10_booked
 * @property int $11_booked
 * @property int $12_booked
 * @property int $13_booked
 * @property string $promo_code
 * @property string $tour_date
 *
 * @package 
 */
class OfferList extends Eloquent
{
	protected $table = 'offer_list';
	public $timestamps = false;

	protected $casts = [
		'01_booked' => 'int',
		'02_booked' => 'int',
		'03_booked' => 'int',
		'04_booked' => 'int',
		'05_booked' => 'int',
		'06_booked' => 'int',
		'07_booked' => 'int',
		'08_booked' => 'int',
		'09_booked' => 'int',
		'10_booked' => 'int',
		'11_booked' => 'int',
		'12_booked' => 'int',
		'13_booked' => 'int'
	];

	protected $fillable = [
		'email',
		'fname',
		'lname',
		'tour_city',
		'tour_id',
		'days_out',
		'01_booked',
		'02_booked',
		'03_booked',
		'04_booked',
		'05_booked',
		'06_booked',
		'07_booked',
		'08_booked',
		'09_booked',
		'10_booked',
		'11_booked',
		'12_booked',
		'13_booked',
		'promo_code',
		'tour_date'
	];
}
