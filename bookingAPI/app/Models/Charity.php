<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Charity
 * 
 * @property int $id
 * @property string $charity_name
 * @property string $description
 * @property string $link
 * @property string $banner_description
 * @property string $video
 * @property string $donate_page_description
 * @property \Carbon\Carbon $created
 * @property \Carbon\Carbon $modified
 *
 * @package 
 */
class Charity extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'created',
		'modified'
	];

	protected $fillable = [
		'charity_name',
		'description',
		'link',
		'banner_description',
		'video',
		'donate_page_description',
		'created',
		'modified'
	];
}
