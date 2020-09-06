<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionInstitucion
 *
 * @property int $id
 * @property string $Nombre_institucion
 * @property int $ID_Responsable
 * @property int|null $ID_Responsable2
 * @property int|null $ID_Membrecia
 * @property int $Numero_docentes_maximos
 * @property int $Numero_grupos_maximos
 * @property int $Numero_alumnos_por_curso
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property MembresiasMembresium $membresias_membresium
 * @property User $user
 * @property Collection|InstitucionAlumno[] $institucion__alumnos
 * @property Collection|InstitucionGrupo[] $institucion__grupos
 * @property Collection|InstitucionProfesore[] $institucion__profesores
 * @package App\Models
 * @property-read int|null $institucion__alumnos_count
 * @property-read int|null $institucion__grupos_count
 * @property-read int|null $institucion__profesores_count
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion query()
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereIDMembrecia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereIDResponsable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereIDResponsable2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereNombreInstitucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereNumeroAlumnosPorCurso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereNumeroDocentesMaximos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereNumeroGruposMaximos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstitucionInstitucion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InstitucionInstitucion extends Model
{

    protected $table = 'institucion__institucion';

    protected $casts = [
        'ID_Responsable' => 'int',
        'ID_Responsable2' => 'int',
        'ID_Membrecia' => 'int',
        'Numero_docentes_maximos' => 'int',
        'Numero_grupos_maximos' => 'int',
        'Numero_alumnos_por_curso' => 'int'
    ];

    protected $fillable = [
        'Nombre_institucion',
        'ID_Responsable',
        'ID_Responsable2',
        'ID_Membrecia',
        'Numero_docentes_maximos',
        'Numero_grupos_maximos',
        'Numero_alumnos_por_curso'
    ];

    public function membresias_membresium()
    {
        return $this->belongsTo(MembresiasMembresium::class, 'ID_Membrecia');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Responsable');
    }

    public function institucion__alumnos()
    {
        return $this->hasMany(InstitucionAlumno::class, 'ID_institucion');
    }

    public function institucion__grupos()
    {
        return $this->hasMany(InstitucionGrupo::class, 'ID_Institucion');
    }

    public function institucion__profesores()
    {
        return $this->hasMany(InstitucionProfesore::class, 'ID_institucion');
    }
}
