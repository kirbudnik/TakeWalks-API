<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesTongue
 * 
 * @property int $id
 * @property string $name
 *
 * @package 
 */
class GuidesTongue extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}
