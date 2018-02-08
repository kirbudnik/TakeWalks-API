<?php

/**
 * Created by Release Model.
 * Date: Thu, 03 Aug 2017 02:23:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $country
 * @property string $ccode
 *
 * @package 
 */
class Country extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'country',
		'ccode'
	];
}
