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
	protected $primaryKey = 'id';
	protected $keyType = 'string';
	public $incrementing = false;
	public $timestamps = false;

	public function elemento()
	{
		return $this->hasOne(Elemento::class, 'centro');
		//return $this->hasMany(Elemento::class, 'centro');
	}

	// public function zona()
	// {
	// 	return $this->belongsTo(Zona::class, 'zona');
	// }

	// public function ubicaciones()
	// {
	// 	return $this->hasMany(Ubicacion::class, 'id_centro', 'id');
	// }
}
