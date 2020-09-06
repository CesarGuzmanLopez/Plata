<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MembresiasMembresium
 *
 * @property int $id
 * @property float $Costo
 * @property Carbon $Duracion
 * @property Carbon $Inicio_disponibilidad
 * @property Carbon $fin_disponibilidad
 * @property int $ID_rol_a_recibir
 * @property int|null $ID_rol_necesario
 * @property int|null $ID_rol_incompatible
 * @property bool $1
 * @property int|null $ID_Usuario
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Role $role
 * @property User $user
 * @property Collection|InstitucionInstitucion[] $institucion__institucions
 * @property Collection|MembresiasGrupo[] $membresias__grupos
 * @property Collection|MembresiasUsuario[] $membresias__usuarios
 * @package App\Models
 * @property-read int|null $institucion__institucions_count
 * @property-read int|null $membresias__grupos_count
 * @property-read int|null $membresias__usuarios_count
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium query()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium where1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereDuracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereFinDisponibilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereIDRolARecibir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereIDRolIncompatible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereIDRolNecesario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereIDUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereInicioDisponibilidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasMembresium whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MembresiasMembresium extends Model
{

    protected $table = 'membresias__membresia';

    protected $casts = [
        'Costo' => 'float',
        'ID_rol_a_recibir' => 'int',
        'ID_rol_necesario' => 'int',
        'ID_rol_incompatible' => 'int',
        'bool',
        'ID_Usuario' => 'int'
    ];

    protected $dates = [
        'Duracion',
        'Inicio_disponibilidad',
        'fin_disponibilidad'
    ];

    protected $fillable = [
        'Costo',
        'Duracion',
        'Inicio_disponibilidad',
        'fin_disponibilidad',
        'ID_rol_a_recibir',
        'ID_rol_necesario',
        'ID_rol_incompatible',
        '1',
        'ID_Usuario'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'ID_rol_necesario');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function institucion__institucions()
    {
        return $this->hasMany(InstitucionInstitucion::class, 'ID_Membrecia');
    }

    public function membresias__grupos()
    {
        return $this->hasMany(MembresiasGrupo::class, 'ID_Membrecia');
    }

    public function membresias__usuarios()
    {
        return $this->hasMany(MembresiasUsuario::class, 'ID_Membrecia');
    }
}
