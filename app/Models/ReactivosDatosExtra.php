<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosDatosExtra
 *
 * @property int $ID_Reactivo
 * @property string $Datos
 * @property ReactivosReactivo $reactivos_reactivo
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosDatosExtra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosDatosExtra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosDatosExtra query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosDatosExtra whereDatos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosDatosExtra whereIDReactivo($value)
 * @mixin \Eloquent
 */
class ReactivosDatosExtra extends Model
{

    protected $table = 'reactivos__datos_extras';

    protected $primaryKey = 'ID_Reactivo';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Reactivo' => 'int'
    ];

    protected $fillable = [
        'Datos'
    ];

    public function reactivos_reactivo()
    {
        return $this->belongsTo(ReactivosReactivo::class, 'ID_Reactivo');
    }
}
