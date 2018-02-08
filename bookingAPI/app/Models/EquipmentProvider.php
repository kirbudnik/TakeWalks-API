<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EquipmentProvider
 * 
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property int $domains_groups_id
 * @property string $notes
 *
 * @package 
 */
class EquipmentProvider extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'domains_groups_id' => 'int'
	];

	protected $fillable = [
		'name',
		'phone',
		'email',
		'domains_groups_id',
		'notes'
	];
}
