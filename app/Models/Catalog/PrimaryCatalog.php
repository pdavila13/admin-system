<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Catalog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrimaryCatalog
 * 
 * @property Carbon|null $fecha
 * @property string $file_name
 * @property string|null $extension
 * @property string|null $ruta
 * @property string|null $ultimo_cambio
 * @property float|null $tamaño
 * @property Carbon|null $time
 *
 * @package App\Models
 */
class PrimaryCatalog extends Model
{
	protected $table = 'catalogoprimaria';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'tamaño' => 'float',
		'time' => 'datetime'
	];

	protected $fillable = [
		'fecha',
		'file_name',
		'extension',
		'ruta',
		'ultimo_cambio',
		'tamaño',
		'time'
	];
}
