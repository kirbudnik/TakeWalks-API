<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Multimedia
 * 
 * @property int $id
 * @property string $file_name
 * @property \Carbon\Carbon $date_uploaded
 *
 * @package 
 */
class Multimedia extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $dates = [
		'date_uploaded'
	];

	protected $fillable = [
		'file_name',
		'date_uploaded'
	];
}
