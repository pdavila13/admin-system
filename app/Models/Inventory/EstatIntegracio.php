<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Elemento;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstatIntegracio
 * 
 * @property int $idestat_integracio
 * @property string|null $descripcio
 *
 * @package App\Models
 */
class EstatIntegracio extends Model
{
	protected $connection = 'inventory';
	protected $table = 'estat_integracio';
	protected $primaryKey = 'idestat_integracio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idestat_integracio' => 'int'
	];

	protected $fillable = [
		'descripcio'
	];

	public function elementos()
	{
		return $this->hasMany(Elemento::class, 'estat_integracio', 'idestat_integracio');
	}
}
