<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use Carbon\Carbon;
use App\Models\Inventory\Tipo;
use App\Models\Inventory\Marca;
use App\Models\Inventory\Centro;
use App\Models\Inventory\Modelo;
use App\Models\Inventory\Perfil;
use App\Models\Inventory\Modality;
use App\Models\Inventory\TipusAparell;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\EstatIntegracio;

/**
 * Class Elemento
 * 
 * @property int $id
 * @property int $tipo
 * @property string $codigo
 * @property string $def
 * @property string $estado
 * @property int $marca
 * @property int $modelo
 * @property string $compo
 * @property string $centro
 * @property string|null $ubicacio
 * @property string|null $etiqueta
 * @property string|null $lt2b
 * @property string $usuario
 * @property Carbon $fecha
 * @property int|null $perfil
 * @property string|null $comentari
 * @property int|null $tipus_aparell
 * @property string|null $aet
 * @property string|null $modality
 * @property string|null $maquina_sap
 * @property string|null $ut
 * @property string|null $codi_evolutiu
 * @property int|null $estat_integracio
 * @property string|null $roseta
 * @property string|null $switch
 * @property Carbon|null $ping
 *
 * @package App\Models
 */
class Elemento extends Model
{
	protected $connection = 'inventory';
	protected $table = 'elemento';
	public $timestamps = false;

	protected $casts = [
		'tipo' => 'int',
		'marca' => 'int',
		'modelo' => 'int',
		'centro' => 'int',
		'fecha' => 'datetime',
		'perfil' => 'int',
		'tipus_aparell' => 'int',
		'estat_integracio' => 'int',
		'v' => 'int'
	];

	protected $fillable = [
		'tipo',
		'codigo',
		'def',
		'estado',
		'marca',
		'modelo',
		'centro',
		'ubicacio',
		'usuario',
		'fecha',
		'perfil',
		'tipus_aparell',
		'aet',
		'modality',
		'maquina_sap',
		'ut',
		'codi_evolutiu',
		'estat_integracio',
		'roseta',
		'switch'
	];

	public function centro()
	{
		return $this->belongsTo(Centro::class, 'centro', 'id');
	}

	public function marca()
	{
		return $this->belongsTo(Marca::class, 'marca', 'ID');
	}

	public function modelo()
	{
		return $this->belongsTo(Modelo::class, 'modelo', 'id');
	}

	public function tipo()
	{
		return $this->belongsTo(Tipo::class, 'tipo', 'id');
	}

	public function perfil()
	{
		return $this->belongsTo(Perfil::class, 'perfil');
	}

	public function tipusAparell() {
		return $this->belongsTo(TipusAparell::class, 'tipus_aparell');
	}

	public function modalities() {
		return $this->hasMany(Modality::class, 'id');
	}

	public function estat_integracio() {
		return $this->belongsTo(EstatIntegracio::class, 'estat_integracio', 'idestat_integracio');
	}
}
