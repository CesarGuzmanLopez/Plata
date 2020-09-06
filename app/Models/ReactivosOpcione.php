<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosOpcione
 *
 * @property int $id
 * @property int|null $ID_Tipo_Pregunta
 * @property string $Enunciado1
 * @property string|null $Datos1
 * @property string|null $Enunciado2
 * @property string|null $Datos2
 * @property ReactivosGruposTipo $reactivos_grupos_tipo
 * @property Collection|ReactivosOpcionesListum[] $reactivos__opciones_lista
 * @property Collection|ReactivosReactivosOpcione[] $reactivos__reactivos_opciones
 * @property Collection|TestsRespuestum[] $tests__respuesta
 * @package App\Models
 * @property-read int|null $reactivos__opciones_lista_count
 * @property-read int|null $reactivos__reactivos_opciones_count
 * @property-read int|null $tests__respuesta_count
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione whereDatos1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione whereDatos2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione whereEnunciado1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione whereEnunciado2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione whereIDTipoPregunta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosOpcione whereId($value)
 * @mixin \Eloquent
 */
class ReactivosOpcione extends Model
{
	protected $table = 'reactivos__opciones';
	public $timestamps = false;

	protected $casts = [
		'ID_Tipo_Pregunta' => 'int'
	];

	protected $fillable = [
		'ID_Tipo_Pregunta',
		'Enunciado1',
		'Datos1',
		'Enunciado2',
		'Datos2'
	];

	public function reactivos_grupos_tipo()
	{
		return $this->belongsTo(ReactivosGruposTipo::class, 'ID_Tipo_Pregunta');
	}

	public function reactivos__opciones_lista()
	{
		return $this->hasMany(ReactivosOpcionesListum::class, 'ID_opcion');
	}

	public function reactivos__reactivos_opciones()
	{
		return $this->hasMany(ReactivosReactivosOpcione::class, 'ID_Opcion');
	}

	public function tests__respuesta()
	{
		return $this->hasMany(TestsRespuestum::class, 'ID_Respuesta');
	}
}
