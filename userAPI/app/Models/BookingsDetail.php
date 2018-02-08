<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class BookingsDetail
 * 
 * @property int $id
 * @property int $bookings_id
 * @property int $events_id
 * @property float $promos_id
 * @property \Carbon\Carbon $events_datetimes
 * @property float $amount_local
 * @property float $amount_converted
 * @property bool $cancelled
 * @property int $number_adults
 * @property int $number_students
 * @property int $number_children
 * @property int $number_seniors
 * @property int $number_infants
 * @property \Carbon\Carbon $res_expiry_date
 * @property bool $is_paid
 * @property bool $pre_exclude
 * @property int $distributors_id
 * @property string $distributor_reference
 * @property string $events_timeslots
 * @property string $transaction_id
 * @property string $bookings_type
 * @property string $bookings_note
 * @property int $stagegroup
 * @property int $stage_id
 * @property \Carbon\Carbon $booking_date
 * @property bool $is_archived
 * @property bool $is_orphaned
 * @property bool $is_listed_payment
 * @property string $adults_price_charged
 * @property string $students_price_charged
 * @property string $children_price_charged
 * @property string $seniors_price_charged
 * @property string $infants_price_charged
 * @property string $payment_transaction_number
 * @property bool $is_refund
 * @property bool $is_invoiced
 * @property string $private_group
 * @property int $package_id
 * @property int $package_stage
 * @property string $imported_promo
 * @property bool $noshow
 * @property bool $addon_exists
 * @property \Carbon\Carbon $date_modified
 * @property float $exchange_rate
 * @property bool $email_sent
 * @property float $charged_local_amount
 * @property float $charged_usd_amount
 * @property float $amount_local_fullprice
 * @property float $charged_converted_amount
 * @property string $api_cancellation_reference
 * @property \Carbon\Carbon $hold_reservation_expiry
 * @property \Carbon\Carbon $utc_hold_expiration
 * @property string $api_booking_status
 * @property string $distributor_tickets_list
 * @property int $pre_exclude_category
 * @property string $pre_exclude_reason
 * @property int $pre_exclude_users_id
 * @property \Carbon\Carbon $pre_exclude_datetime
 * @property string $api_distributor_reference_id
 *
 * @package 
 */
class BookingsDetail extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'bookings_id' => 'int',
		'events_id' => 'int',
		'promos_id' => 'float',
		'amount_local' => 'float',
		'amount_converted' => 'float',
		'cancelled' => 'bool',
		'number_adults' => 'int',
		'number_students' => 'int',
		'number_children' => 'int',
		'number_seniors' => 'int',
		'number_infants' => 'int',
		'is_paid' => 'bool',
		'pre_exclude' => 'bool',
		'distributors_id' => 'int',
		'stagegroup' => 'int',
		'stage_id' => 'int',
		'is_archived' => 'bool',
		'is_orphaned' => 'bool',
		'is_listed_payment' => 'bool',
		'is_refund' => 'bool',
		'is_invoiced' => 'bool',
		'package_id' => 'int',
		'package_stage' => 'int',
		'noshow' => 'bool',
		'addon_exists' => 'bool',
		'exchange_rate' => 'float',
		'email_sent' => 'bool',
		'charged_local_amount' => 'float',
		'charged_usd_amount' => 'float',
		'amount_local_fullprice' => 'float',
		'charged_converted_amount' => 'float',
		'pre_exclude_category' => 'int',
		'pre_exclude_users_id' => 'int'
	];

	protected $dates = [
		'events_datetimes',
		'res_expiry_date',
		'booking_date',
		'date_modified',
		'hold_reservation_expiry',
		'utc_hold_expiration',
		'pre_exclude_datetime'
	];

	protected $fillable = [
		'bookings_id',
		'events_id',
		'promos_id',
		'events_datetimes',
		'amount_local',
		'amount_converted',
		'cancelled',
		'number_adults',
		'number_students',
		'number_children',
		'number_seniors',
		'number_infants',
		'res_expiry_date',
		'is_paid',
		'pre_exclude',
		'distributors_id',
		'distributor_reference',
		'events_timeslots',
		'transaction_id',
		'bookings_type',
		'bookings_note',
		'stagegroup',
		'stage_id',
		'booking_date',
		'is_archived',
		'is_orphaned',
		'is_listed_payment',
		'adults_price_charged',
		'students_price_charged',
		'children_price_charged',
		'seniors_price_charged',
		'infants_price_charged',
		'payment_transaction_number',
		'is_refund',
		'is_invoiced',
		'private_group',
		'package_id',
		'package_stage',
		'imported_promo',
		'noshow',
		'addon_exists',
		'date_modified',
		'exchange_rate',
		'email_sent',
		'charged_local_amount',
		'charged_usd_amount',
		'amount_local_fullprice',
		'charged_converted_amount',
		'api_cancellation_reference',
		'hold_reservation_expiry',
		'utc_hold_expiration',
		'api_booking_status',
		'distributor_tickets_list',
		'pre_exclude_category',
		'pre_exclude_reason',
		'pre_exclude_users_id',
		'pre_exclude_datetime',
		'api_distributor_reference_id'
	];
}
