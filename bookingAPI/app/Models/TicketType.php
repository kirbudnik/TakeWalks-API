<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class TicketType
 * 
 * @property int $id
 * @property int $distributor_id
 * @property string $distributor_ticket_type_id
 * @property string $ticket_name
 * @property string $ticket_description
 *
 * @package 
 */
class TicketType extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'distributor_id' => 'int'
	];

	protected $fillable = [
		'distributor_id',
		'distributor_ticket_type_id',
		'ticket_name',
		'ticket_description'
	];
}
