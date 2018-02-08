<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class SitesReservationsFee
 * 
 * @property int $id
 * @property int $scenarios_id
 * @property bool $group_single
 * @property string $name
 * @property string $description
 * @property float $price_group
 * @property int $from_month
 * @property int $to_month
 * @property bool $fixed
 * @property float $price_adult
 * @property float $price_senior
 * @property float $price_student
 * @property float $price_child
 * @property float $price_infants
 * @property float $group_guide
 *
 * @package 
 */
class SitesReservationsFee extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'scenarios_id' => 'int',
		'group_single' => 'bool',
		'price_group' => 'float',
		'from_month' => 'int',
		'to_month' => 'int',
		'fixed' => 'bool',
		'price_adult' => 'float',
		'price_senior' => 'float',
		'price_student' => 'float',
		'price_child' => 'float',
		'price_infants' => 'float',
		'group_guide' => 'float'
	];

	protected $fillable = [
		'scenarios_id',
		'group_single',
		'name',
		'description',
		'price_group',
		'from_month',
		'to_month',
		'fixed',
		'price_adult',
		'price_senior',
		'price_student',
		'price_child',
		'price_infants',
		'group_guide'
	];
}
