<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EmailElement
 * 
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string $element
 *
 * @package 
 */
class EmailElement extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name',
		'content',
		'element'
	];
}
