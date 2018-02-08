<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Domain
 * 
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $style_sheet
 * @property bool $status
 * @property string $country
 * @property string $infoemail
 * @property string $exchangepair
 * @property string $bookingCondition
 * @property string $feedbackDomainCode
 *
 * @package 
 */
class Domain extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'url',
		'style_sheet',
		'status',
		'country',
		'infoemail',
		'exchangepair',
		'bookingCondition',
		'feedbackDomainCode'
	];
}
