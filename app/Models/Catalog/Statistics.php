<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Catalog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Statistics
 * 
 * @property Carbon|null $fecha
 * @property string|null $operacion
 * @property string|null $ruta
 * @property int|null $registros
 * @property Carbon|null $inicio
 * @property Carbon|null $fin
 * @property Carbon|null $tiempo
 *
 * @package App\Models
 */
class Statistics extends Model
{
	protected $table = 'estadistica';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'registros' => 'int',
		'inicio' => 'datetime',
		'fin' => 'datetime',
		'tiempo' => 'datetime'
	];

	protected $fillable = [
		'fecha',
		'operacion',
		'ruta',
		'registros',
		'inicio',
		'fin',
		'tiempo'
	];
}
