<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Transport
 * 
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property int $country_id
 * @property \Carbon\Carbon $created_on
 * @property int $created_by
 * @property \Carbon\Carbon $modified_on
 * @property int $modified_by
 * @property bool $status
 * @property string $notes
 * @property string $phone
 * @property string $email
 * @property string $bank
 * @property string $languages
 * @property string $licenses
 * @property int $custom_rate
 * @property int $rating
 * @property int $guide_type_id
 * @property string $password
 * @property string $phone_emergency
 * @property string $phone_other
 * @property int $domains_id
 *
 * @package 
 */
class Transport extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'country_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'status' => 'bool',
		'custom_rate' => 'int',
		'rating' => 'int',
		'guide_type_id' => 'int',
		'domains_id' => 'int'
	];

	protected $dates = [
		'created_on',
		'modified_on'
	];

	protected $fillable = [
		'fname',
		'lname',
		'country_id',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
		'status',
		'notes',
		'phone',
		'email',
		'bank',
		'languages',
		'licenses',
		'custom_rate',
		'rating',
		'guide_type_id',
		'password',
		'phone_emergency',
		'phone_other',
		'domains_id'
	];
}
