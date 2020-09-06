<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GuTipo
 *
 * @property int $id
 * @property string $Nombre
 * @property Collection|GuGrupo[] $gu__grupos
 * @package App\Models
 * @property-read int|null $gu__grupos_count
 * @method static \Illuminate\Database\Eloquent\Builder|GuTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GuTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GuTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|GuTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuTipo whereNombre($value)
 * @mixin \Eloquent
 */
class GuTipo extends Model
{

    protected $table = 'gu__tipo';

    public $timestamps = false;

    protected $fillable = [
        'Nombre'
    ];

    public function gu__grupos()
    {
        return $this->hasMany(GuGrupo::class, 'Tipo_Grupo');
    }
}
