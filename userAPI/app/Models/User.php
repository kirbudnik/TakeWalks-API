<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property int $status
 * @property \Carbon\Carbon $created
 * @property \Carbon\Carbon $last_modified
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string $email
 * @property string $reset_hash
 * @property \Carbon\Carbon $reset_datetime
 * @property string $cookie_auth
 *
 * @package 
 */
class User extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $dates = [
		'created',
		'last_modified',
		'reset_datetime'
	];

	protected $fillable = [
		'fname',
		'lname',
		'status',
		'created',
		'last_modified',
		'username',
		'password',
		'role',
		'email',
		'reset_hash',
		'reset_datetime',
		'cookie_auth'
	];
}
