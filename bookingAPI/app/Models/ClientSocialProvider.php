<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientDestination
 * 
 * @property int $id
 * @property string $client_id
 * @property string $city
 *
 * @package 
 */
class ClientSocialProvider extends Model
{
	// public $timestamps = false;

	protected $casts = [
		'client_id' => 'int'
	];

	protected $dates = [
	];

	protected $fillable = [
      'provider',
      'social_user_id',
      'metadata',
	];

	protected $hidden = [
		];
}
