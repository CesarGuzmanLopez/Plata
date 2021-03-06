<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosOpcionesListum
 *
 * @property int $ID_Lista_opcion
 * @property int $ID_opcion
 * @property ReactivosListasOpcione $reactivos_listas_opcione
 * @property ReactivosOpcione $reactivos_opcione
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcionesListum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcionesListum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcionesListum query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcionesListum whereIDListaOpcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcionesListum whereIDOpcion($value)
 * @mixin \Eloquent
 */
class ReactivosOpcionesListum extends Model
{
	protected $table = 'reactivos__opciones_lista';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_Lista_opcion' => 'int',
		'ID_opcion' => 'int'
	];

	public function reactivos_listas_opcione()
	{
		return $this->belongsTo(ReactivosListasOpcione::class, 'ID_Lista_opcion');
	}

	public function reactivos_opcione()
	{
		return $this->belongsTo(ReactivosOpcione::class, 'ID_opcion');
	}
}
