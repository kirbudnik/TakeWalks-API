<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Site
 * 
 * @property int $id
 * @property string $name_short
 * @property string $name_long
 * @property string $description_short
 * @property bool $status
 * @property \Carbon\Carbon $created_on
 * @property int $created_by
 * @property string $address
 * @property string $contact1name
 * @property string $contact1phone
 * @property string $contact1email
 * @property string $contact1description
 * @property string $contact2name
 * @property string $contact2phone
 * @property string $contact2email
 * @property string $contact2description
 * @property string $contact3name
 * @property string $contact3phone
 * @property string $contact3email
 * @property string $contact3description
 * @property string $contact4name
 * @property string $contact4phone
 * @property string $contact4email
 * @property string $contact4description
 * @property string $contact5name
 * @property string $contact5phone
 * @property string $contact5email
 * @property string $contact5description
 * @property string $website1
 * @property string $website2
 * @property string $booking_procedures
 * @property string $notes
 * @property string $opening_days
 * @property bool $single_tickets
 * @property bool $group_tickets
 * @property bool $reservation_code
 * @property bool $voucher
 * @property int $domains_id
 *
 * @package 
 */
class Site extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'bool',
		'created_by' => 'int',
		'single_tickets' => 'bool',
		'group_tickets' => 'bool',
		'reservation_code' => 'bool',
		'voucher' => 'bool',
		'domains_id' => 'int'
	];

	protected $dates = [
		'created_on'
	];

	protected $fillable = [
		'name_short',
		'name_long',
		'description_short',
		'status',
		'created_on',
		'created_by',
		'address',
		'contact1name',
		'contact1phone',
		'contact1email',
		'contact1description',
		'contact2name',
		'contact2phone',
		'contact2email',
		'contact2description',
		'contact3name',
		'contact3phone',
		'contact3email',
		'contact3description',
		'contact4name',
		'contact4phone',
		'contact4email',
		'contact4description',
		'contact5name',
		'contact5phone',
		'contact5email',
		'contact5description',
		'website1',
		'website2',
		'booking_procedures',
		'notes',
		'opening_days',
		'single_tickets',
		'group_tickets',
		'reservation_code',
		'voucher',
		'domains_id'
	];
}
