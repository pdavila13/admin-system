<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Elemento;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Modality
 * 
 * @property int $id
 * @property string|null $modality
 * @property string|null $descripcio
 *
 * @package App\Models
 */
class Modality extends Model
{
	protected $table = 'modalities';
	public $timestamps = false;

	protected $fillable = [
		'modality',
		'descripcio'
	];

	public function elementos()
	{
		return $this->hasMany(Elemento::class, 'moda_id');
	}
}
