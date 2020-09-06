<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosRetroalimentacion
 *
 * @property int $id
 * @property int $ID_Reactivo
 * @property int $ID_Grado
 * @property string|null $Retroalimentacion
 * @property string|null $Datos
 * @property TgGradosAcademico $tg_grados_academico
 * @property ReactivosReactivo $reactivos_reactivo
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosRetroalimentacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosRetroalimentacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosRetroalimentacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosRetroalimentacion whereDatos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosRetroalimentacion whereIDGrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosRetroalimentacion whereIDReactivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosRetroalimentacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosRetroalimentacion whereRetroalimentacion($value)
 * @mixin \Eloquent
 */
class ReactivosRetroalimentacion extends Model
{

    protected $table = 'reactivos__retroalimentacion';
    public $timestamps = false;

    protected $casts = [
        'ID_Reactivo' => 'int',
        'ID_Grado' => 'int'
    ];

    protected $fillable = [
        'Retroalimentacion',
        'Datos'
    ];

    public function tg_grados_academico()
    {
        return $this->belongsTo(TgGradosAcademico::class, 'ID_Grado');
    }

    public function reactivos_reactivo()
    {
        return $this->belongsTo(ReactivosReactivo::class, 'ID_Reactivo');
    }
}
