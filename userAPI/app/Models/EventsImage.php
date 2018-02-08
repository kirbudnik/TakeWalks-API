<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class EventsImage
 * 
 * @property int $id
 * @property int $events_id
 * @property string $images_name
 * @property string $label
 * @property string $alt_tag
 * @property bool $publish
 * @property string $image_type
 * @property int $image_order
 * @property bool $primary
 * @property bool $listing
 * @property bool $feature
 *
 * @package 
 */
class EventsImage extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'events_id' => 'int',
		'publish' => 'bool',
		'image_order' => 'int',
		'primary' => 'bool',
		'listing' => 'bool',
		'feature' => 'bool'
	];

	protected $fillable = [
		'events_id',
		'images_name',
		'label',
		'alt_tag',
		'publish',
		'image_type',
		'image_order',
		'primary',
		'listing',
		'feature'
	];
}
