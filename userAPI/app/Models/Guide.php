<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Guide
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
 * @property string $bank_currency
 * @property string $bank_friendly
 * @property string $languages
 * @property string $licenses
 * @property int $custom_rate
 * @property int $rating
 * @property int $guide_type_id
 * @property bool $can_escort
 * @property string $password
 * @property int $primary_group
 * @property bool $ss_kids
 * @property bool $ss_scholarly
 * @property bool $ss_elegant
 * @property bool $ss_humorous
 * @property bool $ss_charismatic
 * @property string $ss_other
 * @property int $guide_tongues_id
 * @property string $preferred_tour_categories
 * @property bool $portalLink
 * @property string $promoCode
 * @property string $reset_hash
 * @property \Carbon\Carbon $reset_datetime
 * @property string $cookie_auth
 * @property bool $is_admin
 * @property bool $can_switch
 *
 * @package 
 */
class Guide extends Eloquent
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
		'can_escort' => 'bool',
		'primary_group' => 'int',
		'ss_kids' => 'bool',
		'ss_scholarly' => 'bool',
		'ss_elegant' => 'bool',
		'ss_humorous' => 'bool',
		'ss_charismatic' => 'bool',
		'guide_tongues_id' => 'int',
		'portalLink' => 'bool',
		'is_admin' => 'bool',
		'can_switch' => 'bool'
	];

	protected $dates = [
		'created_on',
		'modified_on',
		'reset_datetime'
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
		'bank_currency',
		'bank_friendly',
		'languages',
		'licenses',
		'custom_rate',
		'rating',
		'guide_type_id',
		'can_escort',
		'password',
		'primary_group',
		'ss_kids',
		'ss_scholarly',
		'ss_elegant',
		'ss_humorous',
		'ss_charismatic',
		'ss_other',
		'guide_tongues_id',
		'preferred_tour_categories',
		'portalLink',
		'promoCode',
		'reset_hash',
		'reset_datetime',
		'cookie_auth',
		'is_admin',
		'can_switch'
	];
}
