<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Elemento;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipusAparell
 * 
 * @property int $idtipus_aparell
 * @property string|null $descripcio
 *
 * @package App\Models
 */
class TipusAparell extends Model
{
	protected $connection = 'inventory';
	protected $table = 'tipus_aparell';
	protected $primaryKey = 'idtipus_aparell';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idtipus_aparell' => 'int'
	];

	protected $fillable = [
		'descripcio'
	];

	public function elementos()
	{
		return $this->hasMany(Elemento::class, 'tipus_aparell');
	}
}
