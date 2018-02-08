<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Review
 * 
 * @property int $id
 * @property int $clients_id
 * @property \Carbon\Carbon $created_on
 * @property string $review
 * @property string $response
 * @property bool $status
 *
 * @package 
 */
class Review extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'clients_id' => 'int',
		'status' => 'bool'
	];

	protected $dates = [
		'created_on'
	];

	protected $fillable = [
		'clients_id',
		'created_on',
		'review',
		'response',
		'status'
	];
}
