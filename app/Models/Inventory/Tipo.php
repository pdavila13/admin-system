<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Marca;
use App\Models\Inventory\Modelo;
use App\Models\Inventory\Elemento;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipo
 * 
 * @property int $id
 * @property string $def
 * @property string $icon_o
 * @property string $icon_c
 * @property string $icon_i
 * @property string $icon_r
 * @property string $accion
 * @property int $familia
 * @property string $inventari
 *
 * @package App\Models
 */
class Tipo extends Model
{
	protected $connection = 'inventory';
	protected $table = 'tipo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'familia' => 'int'
	];

	protected $fillable = [
		'def',
		'icon_o',
		'icon_c',
		'icon_i',
		'icon_r',
		'accion',
		'familia',
		'inventari'
	];

	public function elementos()
	{
		return $this->hasMany(Elemento::class);
	}

	public function marcas()
	{
		return $this->hasMany(Marca::class, 'tipo');
	}

	public function modelos()
	{
		return $this->hasMany(Modelo::class, 'tipo');
	}
}
