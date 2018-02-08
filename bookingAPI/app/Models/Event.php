<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Event
 * 
 * @property int $id
 * @property string $name_short
 * @property string $name_long
 * @property string $name_listing
 * @property string $description_short
 * @property string $description_long
 * @property string $description_listing
 * @property int $sku
 * @property int $duration
 * @property bool $is_active
 * @property bool $is_package
 * @property int $pack_1_events_id
 * @property int $pack_2_events_id
 * @property \Carbon\Carbon $pack_1_time
 * @property \Carbon\Carbon $pack_2_time
 * @property int $pack_1_price_percent
 * @property int $pack_2_price_percent
 * @property \Carbon\Carbon $expires
 * @property bool $staging
 * @property int $pax_max
 * @property bool $hard_max
 * @property int $horizon
 * @property int $currencies_id
 * @property string $color
 * @property string $adults_price
 * @property string $students_price
 * @property string $children_price
 * @property string $seniors_price
 * @property string $infants_price
 * @property int $lateDiscount
 * @property int $latePercentage
 * @property string $guide_procedures
 * @property int $group_size
 * @property int $critical_hours
 * @property int $stall_hours
 * @property bool $visible
 * @property bool $needs_transport
 * @property bool $needs_tickets
 * @property bool $needs_guides
 * @property bool $needs_escort
 * @property bool $remove_guide_conflict
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
 * @property int $ticketTimeAfterStart
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
 * @property int $stall_hours_private
 * @property bool $needs_coords
 * @property int $coords_min
 * @property string $page_title
 * @property string $meta_description
 * @property string $display_duration
 * @property string $display_days
 * @property string $display_time
 * @property string $wistia
 * @property string $video
 * @property int $charity_id
 * @property string $street_number
 * @property string $street
 * @property string $city
 * @property string $main_city
 * @property string $city_code
 * @property string $zip_code
 * @property string $province_code
 * @property string $country
 * @property string $country_code
 * @property float $latitude
 * @property float $longitude
 * @property string $language
 * @property bool $allow_double_guides
 * @property int $disable_promos
 * @property string $map_link
 * @property int $hours_notify_within
 *
 * @package 
 */
class Event extends Model
{
	public $timestamps = false;

	protected $casts = [
		'sku' => 'int',
		'duration' => 'int',
		'is_active' => 'bool',
		'is_package' => 'bool',
		'pack_1_events_id' => 'int',
		'pack_2_events_id' => 'int',
		'pack_1_price_percent' => 'int',
		'pack_2_price_percent' => 'int',
		'staging' => 'bool',
		'pax_max' => 'int',
		'hard_max' => 'bool',
		'horizon' => 'int',
		'currencies_id' => 'int',
		'lateDiscount' => 'int',
		'latePercentage' => 'int',
		'group_size' => 'int',
		'critical_hours' => 'int',
		'stall_hours' => 'int',
		'visible' => 'bool',
		'needs_transport' => 'bool',
		'needs_tickets' => 'bool',
		'needs_guides' => 'bool',
		'needs_escort' => 'bool',
		'remove_guide_conflict' => 'bool',
		'needs_equipment' => 'bool',
		'private_base_price' => 'float',
		'private_adults_price' => 'float',
		'private_seniors_price' => 'float',
		'private_students_price' => 'float',
		'private_children_price' => 'float',
		'private_infants_price' => 'float',
		'ticketTimeAfterStart' => 'int',
		'needs_headsets' => 'bool',
		'headsets_min' => 'int',
		'transport_start_after' => 'int',
		'transport_duration' => 'int',
		'custom_event' => 'bool',
		'pace' => 'int',
		'meet_before' => 'int',
		'popularity' => 'int',
		'stall_hours_private' => 'int',
		'needs_coords' => 'bool',
		'coords_min' => 'int',
		'charity_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float',
		'allow_double_guides' => 'bool',
		'disable_promos' => 'int',
		'hours_notify_within' => 'int'
	];

	protected $dates = [
		'pack_1_time',
		'pack_2_time',
		'expires'
	];

	protected $fillable = [
		'name_short',
		'name_long',
		'name_listing',
		'description_short',
		'description_long',
		'description_listing',
		'sku',
		'duration',
		'is_active',
		'is_package',
		'pack_1_events_id',
		'pack_2_events_id',
		'pack_1_time',
		'pack_2_time',
		'pack_1_price_percent',
		'pack_2_price_percent',
		'expires',
		'staging',
		'pax_max',
		'hard_max',
		'horizon',
		'currencies_id',
		'color',
		'adults_price',
		'students_price',
		'children_price',
		'seniors_price',
		'infants_price',
		'lateDiscount',
		'latePercentage',
		'guide_procedures',
		'group_size',
		'critical_hours',
		'stall_hours',
		'visible',
		'needs_transport',
		'needs_tickets',
		'needs_guides',
		'needs_escort',
		'remove_guide_conflict',
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
		'ticketTimeAfterStart',
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
		'stall_hours_private',
		'needs_coords',
		'coords_min',
		'page_title',
		'meta_description',
		'display_duration',
		'display_days',
		'display_time',
		'wistia',
		'video',
		'charity_id',
		'street_number',
		'street',
		'city',
		'main_city',
		'city_code',
		'zip_code',
		'province_code',
		'country',
		'country_code',
		'latitude',
		'longitude',
		'language',
		'allow_double_guides',
		'disable_promos',
		'map_link',
		'hours_notify_within'
	];
}
