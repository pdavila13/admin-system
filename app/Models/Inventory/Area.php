<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Zona;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Area
 * 
 * @property string $id
 * @property string $def
 * @property string $codigo_ext
 * @property string $inventari
 *
 * @package App\Models
 */
class Area extends Model
{
	protected $table = 'area';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'def',
		'codigo_ext',
		'inventari'
	];

	public function zona()
	{
		return $this->hasMany(Zona::class, 'area');
	}
}
