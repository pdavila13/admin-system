<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Elemento;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Perfil
 * 
 * @property int $id_perfil
 * @property string $descripcio_perfil
 *
 * @package App\Models
 */
class Perfil extends Model
{
	protected $table = 'perfils';
	protected $primaryKey = 'id_perfil';
	public $timestamps = false;

	protected $fillable = [
		'descripcio_perfil'
	];

	public function elementos()
	{
		return $this->hasMany(Elemento::class, 'perfil');
	}
}
