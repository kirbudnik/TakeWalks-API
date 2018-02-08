<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Coord
 * 
 * @property int $id
 * @property string $email
 * @property string $fname
 * @property string $lname
 * @property int $primary_group
 * @property string $password
 * @property string $notes
 * @property string $phone
 * @property int $domains_id
 *
 * @package 
 */
class Coord extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'primary_group' => 'int',
		'domains_id' => 'int'
	];

	protected $fillable = [
		'email',
		'fname',
		'lname',
		'primary_group',
		'password',
		'notes',
		'phone',
		'domains_id'
	];
}
