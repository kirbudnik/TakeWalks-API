<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Instagram
 * 
 * @property int $id
 * @property string $link
 * @property string $thumb
 *
 * @package 
 */
class Instagram extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'link',
		'thumb'
	];
}
