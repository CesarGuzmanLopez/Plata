<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GuGrupo
 *
 * @property int $id
 * @property int|null $Tipo_Grupo
 * @property int|null $ID_Usuario_Creador
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property GuTipo $gu_tipo
 * @property Collection|GuIntegrante[] $gu__integrantes
 * @property Collection|MembresiasGrupo[] $membresias__grupos
 * @package App\Models
 * @property-read int|null $gu__integrantes_count
 * @property-read int|null $membresias__grupos_count
 * @method static \Illuminate\Database\Eloquent\Builder|GuGrupo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GuGrupo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GuGrupo query()
 * @method static \Illuminate\Database\Eloquent\Builder|GuGrupo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuGrupo whereIDUsuarioCreador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuGrupo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuGrupo whereTipoGrupo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuGrupo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GuGrupo extends Model
{

    protected $table = 'gu__grupos';

    protected $casts = [
        'Tipo_Grupo' => 'int',
        'ID_Usuario_Creador' => 'int'
    ];

    protected $fillable = [
        'Tipo_Grupo',
        'ID_Usuario_Creador'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_Creador');
    }

    public function gu_tipo()
    {
        return $this->belongsTo(GuTipo::class, 'Tipo_Grupo');
    }

    public function gu__integrantes()
    {
        return $this->hasMany(GuIntegrante::class, 'ID_grupo');
    }

    public function membresias__grupos()
    {
        return $this->hasMany(MembresiasGrupo::class, 'ID_Grupo');
    }
}
