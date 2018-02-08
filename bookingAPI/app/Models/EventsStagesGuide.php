<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsStagesGuide
 * 
 * @property int $id
 * @property int $events_id
 * @property \Carbon\Carbon $events_datetime
 * @property int $guides_id
 * @property bool $is_escort
 * @property int $status
 * @property \Carbon\Carbon $requested_datetime
 * @property \Carbon\Carbon $confirmed_datetime
 * @property \Carbon\Carbon $cancelled_datetime
 * @property int $cancelled_user
 * @property int $cancelCode
 * @property int $stagegroup
 * @property int $stage_id
 * @property int $guides_invoices_id
 * @property float $guide_cost
 * @property float $reimbursements
 * @property string $invoice_notes
 * @property bool $receipt
 * @property bool $email_sent
 * @property bool $available_flag
 *
 * @package 
 */
class EventsStagesGuide extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'guides_id' => 'int',
		'is_escort' => 'bool',
		'status' => 'int',
		'cancelled_user' => 'int',
		'cancelCode' => 'int',
		'stagegroup' => 'int',
		'stage_id' => 'int',
		'guides_invoices_id' => 'int',
		'guide_cost' => 'float',
		'reimbursements' => 'float',
		'receipt' => 'bool',
		'email_sent' => 'bool',
		'available_flag' => 'bool'
	];

	protected $dates = [
		'events_datetime',
		'requested_datetime',
		'confirmed_datetime',
		'cancelled_datetime'
	];

	protected $fillable = [
		'events_id',
		'events_datetime',
		'guides_id',
		'is_escort',
		'status',
		'requested_datetime',
		'confirmed_datetime',
		'cancelled_datetime',
		'cancelled_user',
		'cancelCode',
		'stagegroup',
		'stage_id',
		'guides_invoices_id',
		'guide_cost',
		'reimbursements',
		'invoice_notes',
		'receipt',
		'email_sent',
		'available_flag'
	];
}
