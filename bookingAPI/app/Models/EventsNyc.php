<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsNyc
 * 
 * @property int $id
 * @property string $name_short
 * @property string $name_long
 * @property string $description_short
 * @property string $description_long
 * @property int $duration
 * @property bool $is_active
 * @property \Carbon\Carbon $expires
 * @property bool $staging
 * @property int $pax_max
 * @property int $horizon
 * @property int $currencies_id
 * @property string $color
 * @property string $adults_price
 * @property string $students_price
 * @property string $children_price
 * @property string $seniors_price
 * @property string $infants_price
 * @property string $guide_procedures
 * @property int $group_size
 * @property int $critical_hours
 * @property int $stall_hours
 * @property bool $visible
 * @property bool $needs_transport
 * @property bool $needs_tickets
 * @property bool $needs_guides
 * @property bool $needs_equipment
 * @property string $guide_bring_cash
 * @property float $private_base_price
 * @property float $private_adults_price
 * @property float $private_seniors_price
 * @property float $private_students_price
 * @property float $private_children_price
 * @property float $private_infants_price
 * @property string $bullet1
 * @property string $bullet2
 * @property string $bullet3
 * @property string $sites_included
 * @property string $description_extended
 * @property string $url_name
 * @property string $price_includes
 * @property string $important_information
 * @property string $cs_description
 * @property bool $needs_headsets
 * @property int $headsets_min
 * @property string $internal_note_g
 * @property string $internal_note_p
 * @property string $trans_pickup_g
 * @property string $trans_pickup_p
 * @property string $trans_dropoff_g
 * @property string $trans_dropoff_p
 * @property string $itinerary_g
 * @property string $itinerary_p
 * @property int $transport_start_after
 * @property int $transport_duration
 * @property bool $custom_event
 * @property string $group_private
 * @property int $pace
 * @property int $meet_before
 * @property string $mp_text_g
 * @property string $mp_text_p
 * @property string $endpoint_g
 * @property string $endpoint_p
 * @property string $directions_g
 * @property string $directions_p
 * @property string $mp_image
 * @property string $mp_link
 * @property int $popularity
 * @property string $page_title
 * @property string $meta_description
 * @property string $display_duration
 * @property string $display_days
 * @property string $display_time
 * @property string $wistia
 *
 * @package 
 */
class EventsNyc extends Eloquent
{
	protected $table = 'eventsNyc';
	public $timestamps = false;

	protected $casts = [
		'duration' => 'int',
		'is_active' => 'bool',
		'staging' => 'bool',
		'pax_max' => 'int',
		'horizon' => 'int',
		'currencies_id' => 'int',
		'group_size' => 'int',
		'critical_hours' => 'int',
		'stall_hours' => 'int',
		'visible' => 'bool',
		'needs_transport' => 'bool',
		'needs_tickets' => 'bool',
		'needs_guides' => 'bool',
		'needs_equipment' => 'bool',
		'private_base_price' => 'float',
		'private_adults_price' => 'float',
		'private_seniors_price' => 'float',
		'private_students_price' => 'float',
		'private_children_price' => 'float',
		'private_infants_price' => 'float',
		'needs_headsets' => 'bool',
		'headsets_min' => 'int',
		'transport_start_after' => 'int',
		'transport_duration' => 'int',
		'custom_event' => 'bool',
		'pace' => 'int',
		'meet_before' => 'int',
		'popularity' => 'int'
	];

	protected $dates = [
		'expires'
	];

	protected $fillable = [
		'name_short',
		'name_long',
		'description_short',
		'description_long',
		'duration',
		'is_active',
		'expires',
		'staging',
		'pax_max',
		'horizon',
		'currencies_id',
		'color',
		'adults_price',
		'students_price',
		'children_price',
		'seniors_price',
		'infants_price',
		'guide_procedures',
		'group_size',
		'critical_hours',
		'stall_hours',
		'visible',
		'needs_transport',
		'needs_tickets',
		'needs_guides',
		'needs_equipment',
		'guide_bring_cash',
		'private_base_price',
		'private_adults_price',
		'private_seniors_price',
		'private_students_price',
		'private_children_price',
		'private_infants_price',
		'bullet1',
		'bullet2',
		'bullet3',
		'sites_included',
		'description_extended',
		'url_name',
		'price_includes',
		'important_information',
		'cs_description',
		'needs_headsets',
		'headsets_min',
		'internal_note_g',
		'internal_note_p',
		'trans_pickup_g',
		'trans_pickup_p',
		'trans_dropoff_g',
		'trans_dropoff_p',
		'itinerary_g',
		'itinerary_p',
		'transport_start_after',
		'transport_duration',
		'custom_event',
		'group_private',
		'pace',
		'meet_before',
		'mp_text_g',
		'mp_text_p',
		'endpoint_g',
		'endpoint_p',
		'directions_g',
		'directions_p',
		'mp_image',
		'mp_link',
		'popularity',
		'page_title',
		'meta_description',
		'display_duration',
		'display_days',
		'display_time',
		'wistia'
	];
}
