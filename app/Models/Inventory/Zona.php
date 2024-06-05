<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Inventory;

use App\Models\Inventory\Area;
use App\Models\Inventory\Centro;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Zona
 * 
 * @property string $id
 * @property string $def
 * @property string $area
 * @property string $codigo_ext
 * @property int|null $ip1
 * @property int|null $ip2
 * @property int|null $ip3
 * @property int|null $ip4
 * @property int|null $mask1
 * @property int|null $mask2
 * @property int|null $mask3
 * @property int|null $mask4
 *
 * @package App\Models
 */
class Zona extends Model
{
	protected $table = 'zona';
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
		'mask4' => 'int'
	];

	protected $fillable = [
		'def',
		'area',
		'codigo_ext',
		'ip1',
		'ip2',
		'ip3',
		'ip4',
		'mask1',
		'mask2',
		'mask3',
		'mask4'
	];

	public function area()
	{
		return $this->belongsTo(Area::class, 'area');
	}

	public function centros()
	{
		return $this->hasMany(Centro::class, 'zona');
	}
}
