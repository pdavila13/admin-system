<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Tipo;
use App\Models\Inventory\Marca;
use App\Models\Inventory\Elemento;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Modelo
 * 
 * @property string $def
 * @property int $marca
 * @property int $id
 * @property int|null $tipo
 *
 * @package App\Models
 */
class Modelo extends Model
{
	protected $connection = 'inventory';
	protected $table = 'modelo';
	public $timestamps = false;

	protected $casts = [
		'marca' => 'int',
		'tipo' => 'int'
	];

	protected $fillable = [
		'def',
		'marca',
		'tipo'
	];

	public function elementos()
	{
		return $this->hasMany(Elemento::class, 'modelo', 'id');
	}

	public function tipo()
	{
		return $this->belongsTo(Tipo::class, 'tipo');
	}

	public function marca()
	{
		return $this->belongsTo(Marca::class, 'marca');
	}
}
