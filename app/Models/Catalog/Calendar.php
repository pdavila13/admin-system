<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Catalog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Calendar
 * 
 * @property Carbon|null $fecha
 *
 * @package App\Models
 */
class Calendar extends Model
{
	protected $table = 'calendario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'fecha'
	];
}
