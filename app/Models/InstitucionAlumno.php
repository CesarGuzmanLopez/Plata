<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionAlumno
 *
 * @property int $id
 * @property int $ID_Alumno
 * @property int $ID_institucion
 * @property string|null $Grado_Estudio
 * @property string|null $Descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property InstitucionInstitucion $institucion_institucion
 * @property Collection|InstitucionGrupoAlumno[] $institucion__grupo_alumnos
 * @package App\Models
 * @property-read int|null $institucion__grupo_alumnos_count
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno query()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno whereGradoEstudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno whereIDAlumno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno whereIDInstitucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionAlumno whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InstitucionAlumno extends Model
{

    protected $table = 'institucion__alumnos';

    protected $casts = [
        'ID_Alumno' => 'int',
        'ID_institucion' => 'int'
    ];

    protected $fillable = [
        'ID_Alumno',
        'ID_institucion',
        'Grado_Estudio',
        'Descripcion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Alumno');
    }

    public function institucion_institucion()
    {
        return $this->belongsTo(InstitucionInstitucion::class, 'ID_institucion');
    }

    public function institucion__grupo_alumnos()
    {
        return $this->hasMany(InstitucionGrupoAlumno::class, 'ID_Alumno');
    }
}
