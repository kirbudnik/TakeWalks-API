<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class TripadvisorQuote
 * 
 * @property int $event_id
 * @property string $content
 * @property string $username
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created
 * @property \Carbon\Carbon $modified
 *
 * @package 
 */
class TripadvisorQuote extends Eloquent
{
	protected $primaryKey = 'event_id';
	public $timestamps = false;

	protected $dates = [
		'date',
		'created',
		'modified'
	];

	protected $fillable = [
		'content',
		'username',
		'date',
		'created',
		'modified'
	];
}
