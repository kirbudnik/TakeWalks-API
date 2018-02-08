<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class AuthToken
 * 
 * @property int $id
 * @property string $token
 * @property string $verifier
 * @property int $userid
 * @property \Carbon\Carbon $expires
 *
 * @package 
 */
class AuthToken extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'userid' => 'int'
	];

	protected $dates = [
		'expires'
	];

	protected $fillable = [
		'token',
		'verifier',
		'userid',
		'expires'
	];
}
