<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsReactivo
 *
 * @property int $id
 * @property int $numero
 * @property int $ID_Test
 * @property int $ID_Reactivo
 * @property int|null $tipo
 * @property ReactivosReactivo $reactivos_reactivo
 * @property TestsTest $tests_test
 * @property Collection|TestsReactivoGenerado[] $tests__reactivo_generados
 * @package App\Models
 * @property-read int|null $tests__reactivo_generados_count
 * @method static \Illuminate\Database\Eloquent\Builder|TestsReactivo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsReactivo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsReactivo query()
 * @method static \Illuminate\Database\Eloquent\Builder|TestsReactivo whereIDReactivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestsReactivo whereIDTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestsReactivo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestsReactivo whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TestsReactivo whereTipo($value)
 * @mixin \Eloquent
 */
class TestsReactivo extends Model
{

    protected $table = 'tests__reactivos';

    public $timestamps = false;

    protected $casts = [
        'numero' => 'int',
        'ID_Test' => 'int',
        'ID_Reactivo' => 'int',
        'tipo' => 'int'
    ];

    protected $fillable = [
        'numero',
        'ID_Test',
        'ID_Reactivo',
        'tipo'
    ];

    public function reactivos_reactivo()
    {
        return $this->belongsTo(ReactivosReactivo::class, 'ID_Reactivo');
    }

    public function tests_test()
    {
        return $this->belongsTo(TestsTest::class, 'ID_Test');
    }

    public function tests__reactivo_generados()
    {
        return $this->hasMany(TestsReactivoGenerado::class, 'ID_Reactivo');
    }
}
