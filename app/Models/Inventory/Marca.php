<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Tipo;
use App\Models\Inventory\Modelo;
use App\Models\Inventory\Elemento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Marca
 *
 * @property string $DEF
 * @property int $ID
 * @property int|null $tipo
 *
 * @package App\Models
 */
class Marca extends Model
{
	protected $connection = 'inventory';
	protected $table = 'marca';
	protected $primaryKey = 'ID';
	public $timestamps = false;

	protected $casts = [
		'tipo' => 'int'
	];

	protected $fillable = [
		'DEF',
		'tipo'
	];

	public function elementos()
	{
		return $this->hasMany(Elemento::class, 'marca', 'ID');
	}

	public function tipo()
	{
		return $this->belongsTo(Tipo::class, 'tipo');
	}

	public function modelos()
	{
		return $this->hasMany(Modelo::class, 'marca');
	}
}
