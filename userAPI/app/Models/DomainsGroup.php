<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class DomainsGroup
 * 
 * @property int $id
 * @property int $domains_id
 * @property string $name
 * @property string $name_local
 * @property int $display_order
 * @property string $timezone
 * @property \Carbon\Carbon $create_on
 * @property int $create_by
 * @property int $groups_type
 * @property string $url_name
 * @property string $page_title
 * @property string $meta_description
 * @property string $hero
 * @property string $thumb
 * @property string $homepage
 * @property int $allow_guides
 *
 * @package 
 */
class DomainsGroup extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'domains_id' => 'int',
		'display_order' => 'int',
		'create_by' => 'int',
		'groups_type' => 'int',
		'allow_guides' => 'int'
	];

	protected $dates = [
		'create_on'
	];

	protected $fillable = [
		'domains_id',
		'name',
		'name_local',
		'display_order',
		'timezone',
		'create_on',
		'create_by',
		'groups_type',
		'url_name',
		'page_title',
		'meta_description',
		'hero',
		'thumb',
		'homepage',
		'allow_guides'
	];
}
