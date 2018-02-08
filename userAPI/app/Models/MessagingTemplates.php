<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * 
 * @property int $id
 * @property string $name
 * @property string $class
 * @property string $market
 * @property string $language
 * @property string $endpoint
 * @property string $content
 *
 * @package 
 */
class MessagingTemplates extends Model
{
	
	// public $timestamps = false;

	protected $casts = [
	];

	protected $dates = [
	];

	protected $fillable = [
      'name',  // 
      'class', // Can be reciept|intenary|password
      'market',
      'language',
      'endpoint',
      'content',
	];

	protected $hidden = [
		];

}
