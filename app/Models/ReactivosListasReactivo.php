<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosListasReactivo
 *
 * @property int $id
 * @property string $Nombre
 * @property int|null $ID_Creador
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Collection|ReactivosReactivoListum[] $reactivos__reactivo_lista
 * @package App\Models
 * @property-read int|null $reactivos__reactivo_lista_count
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosListasReactivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosListasReactivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosListasReactivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosListasReactivo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosListasReactivo whereIDCreador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosListasReactivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosListasReactivo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosListasReactivo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReactivosListasReactivo extends Model
{
	protected $table = 'reactivos__listas_reactivo';

	protected $casts = [
		'ID_Creador' => 'int'
	];

	protected $fillable = [
		'Nombre',
		'ID_Creador'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'ID_Creador');
	}

	public function reactivos__reactivo_lista()
	{
		return $this->hasMany(ReactivosReactivoListum::class, 'ID_Lista_Reactivo');
	}
}
