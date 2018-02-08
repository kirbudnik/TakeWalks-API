<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class Tag
 * 
 * @property int $id
 * @property string $name
 * @property bool $status
 * @property string $url_name
 * @property string $page_title
 * @property string $meta_description
 * @property int $tag_type
 *
 * @package 
 */
class Tag extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'status' => 'bool',
		'tag_type' => 'int'
	];

	protected $fillable = [
		'name',
		'status',
		'url_name',
		'page_title',
		'meta_description',
		'tag_type'
	];
}
