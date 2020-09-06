<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @property int $id
 * @property string|null $Nombre
 * @property string $Slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|MembresiasMembresium[] $membresias__membresia
 * @property Collection|PaginasPagina[] $paginas__paginas
 * @property Collection|Permiso[] $permisos
 * @property Collection|User[] $users
 * @package App\Models
 * @property-read int|null $membresias__membresia_count
 * @property-read int|null $paginas__paginas_count
 * @property-read int|null $permisos_count
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{

    protected $table = 'roles';

    protected $fillable = [
        'Nombre',
        'Slug'
    ];

    public function membresias__membresia()
    {
        return $this->hasMany(MembresiasMembresium::class, 'ID_rol_necesario');
    }

    public function paginas__paginas()
    {
        return $this->hasMany(PaginasPagina::class, 'ID_Rol_Permitido');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'roles_permisos', 'ID_Role', 'ID_Permiso')->withPivot('Verificado');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles', 'ID_Role', 'ID_Usuario');
    }
}
