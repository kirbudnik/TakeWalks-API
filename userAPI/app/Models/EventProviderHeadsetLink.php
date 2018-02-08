<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventProviderHeadsetLink
 * 
 * @property int $id
 * @property int $headset_id
 * @property int $event_id
 * @property string $email_template
 * @property string $email_subject
 *
 * @package 
 */
class EventProviderHeadsetLink extends Eloquent
{
	protected $table = 'event_provider_headset_link';
	public $timestamps = false;

	protected $casts = [
		'headset_id' => 'int',
		'event_id' => 'int'
	];

	protected $fillable = [
		'headset_id',
		'event_id',
		'email_template',
		'email_subject'
	];
}
