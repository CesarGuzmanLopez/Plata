<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersPermiso
 *
 * @property int $ID_Permiso
 * @property int $ID_Usuario
 * @property Permiso $permiso
 * @property User $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|UsersPermiso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersPermiso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersPermiso query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersPermiso whereIDPermiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersPermiso whereIDUsuario($value)
 * @mixin \Eloquent
 */
class UsersPermiso extends Model
{

    protected $table = 'users_permisos';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Permiso' => 'int',
        'ID_Usuario' => 'int'
    ];

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'ID_Permiso');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }
}
