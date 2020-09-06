<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsListanegra
 *
 * @property int $ID_Usuario
 * @property int $ID_Test
 * @property string $Datos
 * @property TestsTest $tests_test
 * @property User $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|TestsListanegra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsListanegra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsListanegra query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsListanegra whereDatos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestsListanegra whereIDTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestsListanegra whereIDUsuario($value)
 * @mixin \Eloquent
 */
class TestsListanegra extends Model
{

    protected $table = 'tests__listanegra';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Usuario' => 'int',
        'ID_Test' => 'int'
    ];

    protected $fillable = [
        'Datos'
    ];

    public function tests_test()
    {
        return $this->belongsTo(TestsTest::class, 'ID_Test');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }
}
