<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Headset
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property float $cost_full
 * @property float $cost_half
 * @property int $min_number
 * @property int $primary_group
 * @property int $domains_id
 *
 * @package 
 */
class Headset extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cost_full' => 'float',
		'cost_half' => 'float',
		'min_number' => 'int',
		'primary_group' => 'int',
		'domains_id' => 'int'
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'cost_full',
		'cost_half',
		'min_number',
		'primary_group',
		'domains_id'
	];
}
