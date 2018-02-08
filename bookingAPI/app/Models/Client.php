<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:49:08 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * 
 * @property int $id
 * @property string $user_name
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property \Carbon\Carbon $createdate
 * @property int $countries_id
 * @property string $mobile_number
 * @property string $home_number
 * @property string $title
 * @property string $password
 * @property string $account_status
 * @property string $learned_about_walks
 * @property bool $is_subscribed
 * @property \Carbon\Carbon $last_time_logged_in
 * @property string $last_ip_address_used
 * @property \Carbon\Carbon $last_purchase_date
 * @property int $agents_id
 * @property string $cookie_auth
 * @property string $facebook_id
 * @property string $contact_email
 * @property int $guest
 * @property string $audience_reward
 *  @property string $reset_hash
 *
 * @package 
 */
class Client extends Model
{
	public $timestamps = false;

	protected $casts = [
		'countries_id' => 'int',
		'is_subscribed' => 'bool',
		'agents_id' => 'int',
		'guest' => 'int'
	];

	protected $dates = [
		'createdate',
		'last_time_logged_in',
		'last_purchase_date'
	];

	protected $fillable = [
		'user_name',
		'fname',
		'lname',
		'email',
		'address',
		'city',
		'state',
		'zip',
		'createdate',
		'countries_id',
		'mobile_number',
		'home_number',
		'title',
		'password',
		'account_status',
		'learned_about_walks',
		'is_subscribed',
		'last_time_logged_in',
		'last_ip_address_used',
		'last_purchase_date',
		'agents_id',
		'cookie_auth',
		'facebook_id',
		'contact_email',
		'guest',
		'audience_reward',
		'reset_hash'
	];

	protected $hidden = [
		'password'
		];
}
