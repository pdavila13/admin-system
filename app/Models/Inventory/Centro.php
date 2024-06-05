<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Zona;
use App\Models\Inventory\Elemento;
use App\Models\Inventory\Ubicacion;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Centro
 * 
 * @property string $zona
 * @property string $id
 * @property string $def
 * @property int|null $ip1
 * @property int|null $ip2
 * @property int|null $ip3
 * @property int|null $ip4
 * @property int|null $mask1
 * @property int|null $mask2
 * @property int|null $mask3
 * @property int|null $mask4
 * @property string $usuario
 * @property string|null $codi
 * @property int|null $codi_ctti
 * @property string $adresa
 * @property string $poblacio
 * @property string $telefon
 * @property string|null $codigo_ext
 * @property float|null $latitud
 * @property float|null $longitud
 * @property string|null $horari
 * @property string|null $velocitat
 * @property string|null $tipus_linea
 * @property string|null $codiclasse
 * @property string|null $centro_ref
 * @property int $visible
 * @property int $vista
 * @property int|null $id_rgeneral
 * @property string|null $consultori_de
 * @property string|null $tipus_centre
 *
 * @package App\Models
 */
class Centro extends Model
{
	protected $connection = 'inventory';
	protected $table = 'centro';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ip1' => 'int',
		'ip2' => 'int',
		'ip3' => 'int',
		'ip4' => 'int',
		'mask1' => 'int',
		'mask2' => 'int',
		'mask3' => 'int',
		'mask4' => 'int',
		'codi_ctti' => 'int',
		'latitud' => 'float',
		'longitud' => 'float',
		'visible' => 'int',
		'vista' => 'int',
		'id_rgeneral' => 'int'
	];

	protected $fillable = [
		'zona',
		'def',
		'ip1',
		'ip2',
		'ip3',
		'ip4',
		'mask1',
		'mask2',
		'mask3',
		'mask4',
		'usuario',
		'codi',
		'codi_ctti',
		'adresa',
		'poblacio',
		'telefon',
		'codigo_ext',
		'latitud',
		'longitud',
		'horari',
		'velocitat',
		'tipus_linea',
		'codiclasse',
		'centro_ref',
		'visible',
		'vista',
		'id_rgeneral',
		'consultori_de',
		'tipus_centre'
	];

	public function zona()
	{
		return $this->belongsTo(Zona::class, 'zona');
	}

	public function ubicaciones()
	{
		return $this->hasMany(Ubicacion::class, 'centro');
	}

	public function elementos()
	{
		return $this->hasMany(Elemento::class, 'centro', 'id');
	}
}
