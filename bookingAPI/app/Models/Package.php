<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Package
 * 
 * @property int $id
 * @property string $package_name
 * @property string $package_description
 * @property string $package_price
 * @property \Carbon\Carbon $package_start_date
 * @property \Carbon\Carbon $package_end_date
 * @property string $adult_package_price
 * @property string $senior_package_price
 * @property string $student_package_price
 * @property string $children_package_price
 * @property string $infant_package_price
 * @property string $total_duration
 * @property string $package_max_pax
 * @property string $private_group
 * @property string $package_note
 *
 * @package 
 */
class Package extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'package_start_date',
		'package_end_date'
	];

	protected $fillable = [
		'package_name',
		'package_description',
		'package_price',
		'package_start_date',
		'package_end_date',
		'adult_package_price',
		'senior_package_price',
		'student_package_price',
		'children_package_price',
		'infant_package_price',
		'total_duration',
		'package_max_pax',
		'private_group',
		'package_note'
	];
}
