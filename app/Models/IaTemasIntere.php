<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IaTemasIntere
 *
 * @property int $ID_IA
 * @property int $ID_Tema_Interes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property IaUsuario $ia_usuario
 * @property ReactivosTemasInterest $reactivos_temas_interest
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasIntere newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasIntere newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasIntere query()
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasIntere whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasIntere whereIDIA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasIntere whereIDTemaInteres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaTemasIntere whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IaTemasIntere extends Model
{

    protected $table = 'ia__temas_interes';

    public $incrementing = false;

    protected $casts = [
        'ID_IA' => 'int',
        'ID_Tema_Interes' => 'int'
    ];

    public function ia_usuario()
    {
        return $this->belongsTo(IaUsuario::class, 'ID_IA');
    }

    public function reactivos_temas_interest()
    {
        return $this->belongsTo(ReactivosTemasInterest::class, 'ID_Tema_Interes');
    }
}
