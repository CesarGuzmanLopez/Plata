<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IaBusqueda
 *
 * @property int $ID_IA
 * @property string $Busqueda
 * @property int $Contador
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property IaUsuario $ia_usuario
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|IaBusqueda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IaBusqueda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IaBusqueda query()
 * @method static \Illuminate\Database\Eloquent\Builder|IaBusqueda whereBusqueda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaBusqueda whereContador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaBusqueda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaBusqueda whereIDIA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IaBusqueda whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IaBusqueda extends Model
{

    protected $table = 'ia__busquedas';

    public $incrementing = false;

    protected $casts = [
        'ID_IA' => 'int',
        'Contador' => 'int'
    ];

    protected $fillable = [
        'ID_IA',
        'Busqueda',
        'Contador'
    ];

    public function ia_usuario()
    {
        return $this->belongsTo(IaUsuario::class, 'ID_IA');
    }
}
