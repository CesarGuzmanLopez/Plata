<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 *
 * @property int $id
 * @property string|null $Nombre
 * @property string $Slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Role[] $roles
 * @property Collection|User[] $users
 * @package App\Models
 * @property-read int|null $roles_count
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permiso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permiso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permiso query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permiso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permiso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permiso whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permiso whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permiso whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permiso extends Model
{

    protected $table = 'permisos';

    protected $fillable = [
        'Nombre',
        'Slug'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permisos', 'ID_Permiso', 'ID_Role')->withPivot('Verificado');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permisos', 'ID_Permiso', 'ID_Usuario');
    }
}
