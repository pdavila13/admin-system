<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Centro;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ubicacion
 * 
 * @property string $id_centro
 * @property string $planta
 * @property string $edifici
 *
 * @package App\Models
 */
class Ubicacion extends Model
{
	protected $table = 'ubicacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'planta',
		'edifici'
	];

	public function centro()
	{
		return $this->belongsTo(Centro::class, 'id_centro');
	}
}
