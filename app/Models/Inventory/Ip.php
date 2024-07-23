<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Elemento;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ip
 * 
 * @property int $id
 * @property int $ip1
 * @property int $ip2
 * @property int $ip3
 * @property int $ip4
 *
 * @package App\Models
 */
class Ip extends Model
{
	protected $table = 'ip';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'ip1' => 'int',
		'ip2' => 'int',
		'ip3' => 'int',
		'ip4' => 'int'
	];

	protected $fillable = [
		'ip1',
		'ip2',
		'ip3',
		'ip4'
	];

	public function elemento()
	{
		return $this->belongsTo(Elemento::class, 'id');
	}
}
