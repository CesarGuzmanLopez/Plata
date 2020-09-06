<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IaTemasRevisado
 *
 * @property int $ID_IA
 * @property int $ID_Tema_Visto
 * @property string $Data
 * @property float $Calificacion
 * @property int $NumeroPreguntas
 * @property int $Tiempo_dedicado_en_preguntas
 * @property int $Tiempo_dedicado_en_material
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property IaUsuario $ia_usuario
 * @property TgTema $tg_tema
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado query()
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereCalificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereIDIA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereIDTemaVisto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereNumeroPreguntas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereTiempoDedicadoEnMaterial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereTiempoDedicadoEnPreguntas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasRevisado whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IaTemasRevisado extends Model
{

    protected $table = 'ia__temas_revisados';

    public $incrementing = false;

    protected $casts = [
        'ID_IA' => 'int',
        'ID_Tema_Visto' => 'int',
        'Calificacion' => 'float',
        'NumeroPreguntas' => 'int',
        'Tiempo_dedicado_en_preguntas' => 'int',
        'Tiempo_dedicado_en_material' => 'int'
    ];

    protected $fillable = [
        'Data',
        'Calificacion',
        'NumeroPreguntas',
        'Tiempo_dedicado_en_preguntas',
        'Tiempo_dedicado_en_material'
    ];

    public function ia_usuario()
    {
        return $this->belongsTo(IaUsuario::class, 'ID_IA');
    }

    public function tg_tema()
    {
        return $this->belongsTo(TgTema::class, 'ID_Tema_Visto');
    }
}
