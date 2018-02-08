<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class GuidesInvoice
 * 
 * @property int $id
 * @property int $guides_id
 * @property float $total_fee
 * @property \Carbon\Carbon $datetime
 * @property string $notes
 * @property int $status
 * @property \Carbon\Carbon $payment_datetime
 * @property float $additional_costs
 * @property string $manage_notes
 * @property float $add1
 * @property float $add2
 * @property float $add3
 * @property float $add4
 * @property float $add5
 * @property string $addnote1
 * @property string $addnote2
 * @property string $addnote3
 * @property string $addnote4
 * @property string $addnote5
 * @property string $guide_invoice_number
 * @property string $tour_dates_json
 *
 * @package 
 */
class GuidesInvoice extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'guides_id' => 'int',
		'total_fee' => 'float',
		'status' => 'int',
		'additional_costs' => 'float',
		'add1' => 'float',
		'add2' => 'float',
		'add3' => 'float',
		'add4' => 'float',
		'add5' => 'float'
	];

	protected $dates = [
		'datetime',
		'payment_datetime'
	];

	protected $fillable = [
		'guides_id',
		'total_fee',
		'datetime',
		'notes',
		'status',
		'payment_datetime',
		'additional_costs',
		'manage_notes',
		'add1',
		'add2',
		'add3',
		'add4',
		'add5',
		'addnote1',
		'addnote2',
		'addnote3',
		'addnote4',
		'addnote5',
		'guide_invoice_number',
		'tour_dates_json'
	];
}
