<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionGrupo
 *
 * @property int $id
 * @property int $ID_Institucion
 * @property int $ID_Profesor
 * @property int $ID_Curso
 * @property string $Descripcion
 * @property string $Data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property TgCurso $tg_curso
 * @property InstitucionInstitucion $institucion_institucion
 * @property InstitucionProfesore $institucion_profesore
 * @property Collection|InstitucionGrupoAlumno[] $institucion__grupo_alumnos
 * @package App\Models
 * @property-read int|null $institucion__grupo_alumnos_count
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo query()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo whereIDCurso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo whereIDInstitucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo whereIDProfesor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionGrupo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InstitucionGrupo extends Model
{

    protected $table = 'institucion__grupos';

    protected $casts = [
        'ID_Institucion' => 'int',
        'ID_Profesor' => 'int',
        'ID_Curso' => 'int'
    ];

    protected $fillable = [
        'ID_Institucion',
        'ID_Profesor',
        'ID_Curso',
        'Descripcion',
        'Data'
    ];

    public function tg_curso()
    {
        return $this->belongsTo(TgCurso::class, 'ID_Curso');
    }

    public function institucion_institucion()
    {
        return $this->belongsTo(InstitucionInstitucion::class, 'ID_Institucion');
    }

    public function institucion_profesore()
    {
        return $this->belongsTo(InstitucionProfesore::class, 'ID_Profesor');
    }

    public function institucion__grupo_alumnos()
    {
        return $this->hasMany(InstitucionGrupoAlumno::class, 'ID_Grupo');
    }
}
