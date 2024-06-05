<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Historial
 * 
 * @property int $id
 * @property int|null $elemento
 * @property int|null $elemento_desti
 * @property int $accio
 * @property string $comentari
 * @property string $usuari
 *
 * @package App\Models
 */
class Historial extends Model
{
	protected $table = 'historial';
	public $timestamps = false;

	protected $casts = [
		'elemento' => 'int',
		'elemento_desti' => 'int',
		'accio' => 'int'
	];

	protected $fillable = [
		'elemento',
		'elemento_desti',
		'accio',
		'comentari',
		'usuari'
	];
}
