<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientDestination
 * 
 * @property int $id
 * @property string $client_id
 * @property string $traveler_client_id
 *
 * @package 
 */
class ClientTraveler extends Model
{
	// public $timestamps = false;

	protected $casts = [
		'client_id' => 'int'
	];

	protected $dates = [
	];

	protected $fillable = [
      'traveler_client_id',
	];

	protected $hidden = [
		];
}
