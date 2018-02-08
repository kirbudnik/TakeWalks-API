<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingsPromo
 * 
 * @property int $id
 * @property string $promo_name
 * @property string $promo_description
 * @property string $promo_code
 * @property string $promo_tour_type
 * @property \Carbon\Carbon $booking_start_date
 * @property \Carbon\Carbon $booking_end_date
 * @property \Carbon\Carbon $event_start_date
 * @property \Carbon\Carbon $event_end_date
 * @property string $events_id
 * @property string $associated_tags
 * @property string $discount_amount
 * @property string $min_cart_value
 * @property string $private_group
 * @property string $promo_terms_conditions
 * @property bool $adults
 * @property bool $seniors
 * @property bool $students
 * @property bool $children
 * @property bool $infants
 * @property string $promo_type
 * @property bool $active
 * @property bool $fixed
 * @property bool $fixed_cart
 * @property string $evergreen
 * @property int $min_events
 * @property int $type_id
 * @property int $guides_id
 * @property int $guide_channel
 * @property \Carbon\Carbon $email_date
 * @property int $exclude_override
 *
 * @package 
 */
class BookingsPromo extends Model
{
	public $timestamps = false;

	protected $casts = [
		'adults' => 'bool',
		'seniors' => 'bool',
		'students' => 'bool',
		'children' => 'bool',
		'infants' => 'bool',
		'active' => 'bool',
		'fixed' => 'bool',
		'fixed_cart' => 'bool',
		'min_events' => 'int',
		'type_id' => 'int',
		'guides_id' => 'int',
		'guide_channel' => 'int',
		'exclude_override' => 'int'
	];

	protected $dates = [
		'booking_start_date',
		'booking_end_date',
		'event_start_date',
		'event_end_date',
		'email_date'
	];

	protected $fillable = [
		'promo_name',
		'promo_description',
		'promo_code',
		'promo_tour_type',
		'booking_start_date',
		'booking_end_date',
		'event_start_date',
		'event_end_date',
		'events_id',
		'associated_tags',
		'discount_amount',
		'min_cart_value',
		'private_group',
		'promo_terms_conditions',
		'adults',
		'seniors',
		'students',
		'children',
		'infants',
		'promo_type',
		'active',
		'fixed',
		'fixed_cart',
		'evergreen',
		'min_events',
		'type_id',
		'guides_id',
		'guide_channel',
		'email_date',
		'exclude_override'
	];
}
