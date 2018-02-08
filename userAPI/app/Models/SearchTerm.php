<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace ;

use  as Eloquent;

/**
 * Class SearchTerm
 * 
 * @property int $id
 * @property string $keyword
 * @property string $misspellings
 * @property string $synonyms
 *
 * @package 
 */
class SearchTerm extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'keyword',
		'misspellings',
		'synonyms'
	];
}
