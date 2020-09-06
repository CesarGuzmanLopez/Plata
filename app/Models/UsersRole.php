<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersRole
 *
 * @property int $ID_Role
 * @property int $ID_Usuario
 * @property Role $role
 * @property User $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|UsersRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersRole whereIDRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersRole whereIDUsuario($value)
 * @mixin \Eloquent
 */
class UsersRole extends Model
{

    protected $table = 'users_roles';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Role' => 'int',
        'ID_Usuario' => 'int'
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'ID_Role');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }
}
