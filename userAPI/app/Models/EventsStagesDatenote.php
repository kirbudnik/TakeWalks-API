<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesDatenote
 * 
 * @property int $id
 * @property \Carbon\Carbon $note_date
 * @property string $content
 *
 * @package 
 */
class EventsStagesDatenote extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'note_date'
	];

	protected $fillable = [
		'note_date',
		'content'
	];
}
