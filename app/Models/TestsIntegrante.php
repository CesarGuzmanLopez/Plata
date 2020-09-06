<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsIntegrante
 *
 * @property int $ID_Usuario
 * @property int $ID_Grupo
 * @property TestsGrupo $tests_grupo
 * @property User $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|TestsIntegrante newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsIntegrante newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsIntegrante query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsIntegrante whereIDGrupo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestsIntegrante whereIDUsuario($value)
 * @mixin \Eloquent
 */
class TestsIntegrante extends Model
{

    protected $table = 'tests__integrantes';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Usuario' => 'int',
        'ID_Grupo' => 'int'
    ];

    public function tests_grupo()
    {
        return $this->belongsTo(TestsGrupo::class, 'ID_Grupo');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }
}
