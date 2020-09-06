<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosGruposTipo
 * <autodoc>
 *
 * @property int $id
 * @property string $Nombre
 * @property string $Descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|ReactivosReactivo[] $reactivos__reactivos
 * @property Collection|ReactivosTipo[] $reactivos__tipos
 * @property Collection|ReactivosOpcione[] $reactivos__Opciones
 * @package App\Models
 * </autodoc>
 * @property-read int|null $reactivos___opciones_count
 * @property-read int|null $reactivos__reactivos_count
 * @property-read int|null $reactivos__tipos_count
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosGruposTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosGruposTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosGruposTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosGruposTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosGruposTipo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosGruposTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosGruposTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosGruposTipo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReactivosGruposTipo extends Model
{

    protected $table = 'reactivos__grupos_tipos';

    protected $fillable = [
        'Nombre',
        'Descripcion'
    ];

    public function reactivos__reactivos()
    {
        return $this->hasMany(ReactivosReactivo::class, 'ID_Grupo_Reactivos');
    }

    public function reactivos__tipos()
    {
        return $this->hasMany(ReactivosTipo::class, 'ID_Grupo');
    }
    
    
    public function reactivos__Opciones()
    {
        return $this->hasMany(ReactivosOpcione::class, 'ID_Tipo_Pregunta');
    }
}
