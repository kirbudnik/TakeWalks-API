<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventsStagesPaxInventory
 * 
 * @property int $id
 * @property int $event_id
 * @property int $stage_id
 * @property int $booking_detail_id
 * @property string $pax_type
 * @property string $pax_status
 * @property int $hold_id
 *
 * @package 
 */
class EventsStagesPaxInventory extends Model
{
	public $timestamps = false;

        protected $table = 'events_stages_pax_inventory';
        
	protected $fillable = [
		'bookings_id',
		'events_id',
		'booking_detail_id',
		'pax_type', // adult|senior|student|child|infant
		'pax_status', // free|reserved|hold|confirmed|cancelled
		'hold_id'
	];
}
