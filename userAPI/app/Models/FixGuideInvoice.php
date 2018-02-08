<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class FixGuideInvoice
 * 
 * @property int $id
 * @property \Carbon\Carbon $events_datetime
 * @property int $guides_id
 * @property int $stage_id
 * @property int $guides_invoices_id
 *
 * @package 
 */
class FixGuideInvoice extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'guides_id' => 'int',
		'stage_id' => 'int',
		'guides_invoices_id' => 'int'
	];

	protected $dates = [
		'events_datetime'
	];

	protected $fillable = [
		'events_datetime',
		'guides_id',
		'stage_id',
		'guides_invoices_id'
	];
}
