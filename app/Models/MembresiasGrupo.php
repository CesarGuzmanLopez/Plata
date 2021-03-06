<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MembresiasGrupo
 *
 * @property int $ID_Grupo
 * @property int $ID_Membrecia
 * @property string $Numero_Membrecia
 * @property Carbon $Inicio
 * @property Carbon $Fin
 * @property int|null $ID_tiket
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property GuGrupo $gu_grupo
 * @property MembresiasMembresium $membresias_membresium
 * @property MembresiasTiket $membresias_tiket
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo query()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo whereIDGrupo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo whereIDMembrecia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo whereIDTiket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo whereInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo whereNumeroMembrecia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasGrupo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MembresiasGrupo extends Model
{

    protected $table = 'membresias__grupo';

    public $incrementing = false;

    protected $casts = [
        'ID_Grupo' => 'int',
        'ID_Membrecia' => 'int',
        'ID_tiket' => 'int'
    ];

    protected $dates = [
        'Inicio',
        'Fin'
    ];

    protected $fillable = [
        'Numero_Membrecia',
        'Inicio',
        'Fin',
        'ID_tiket'
    ];

    public function gu_grupo()
    {
        return $this->belongsTo(GuGrupo::class, 'ID_Grupo');
    }

    public function membresias_membresium()
    {
        return $this->belongsTo(MembresiasMembresium::class, 'ID_Membrecia');
    }

    public function membresias_tiket()
    {
        return $this->belongsTo(MembresiasTiket::class, 'ID_tiket');
    }
}
