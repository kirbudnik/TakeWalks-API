<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientDestination
 * 
 * @property int $id
 * @property string $client_id
 * @property string $city
 * @property string $hotelPhone
 * @property string $hotelEmail
 * @property string $startDate
 * @property string $endDate
 *
 * @package 
 */
class ClientDestination extends Model
{
	// public $timestamps = false;

	protected $casts = [
		'client_id' => 'int'
	];

	protected $dates = [
		'startDate',
		'endDate'
	];

	protected $fillable = [
      'city',
      'hotel',
      'hotelPhone',
      'hotelEmail',
      'startDate',
      'endDate'
	];

	protected $hidden = [
		];
}
