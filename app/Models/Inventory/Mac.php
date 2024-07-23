<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mac
 * 
 * @property string $ip
 * @property string $mac
 *
 * @package App\Models
 */
class Mac extends Model
{
	protected $table = 'macs';
	protected $primaryKey = 'ip';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'mac'
	];
}
