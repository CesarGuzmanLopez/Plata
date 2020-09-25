<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TgSubtemasDifuso
 *
 * @property int $ID_Tema
 * @property int $ID_Subtema
 * @property float $valor
 * @property TgTema $tg_tema
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|TgSubtemasDifuso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TgSubtemasDifuso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TgSubtemasDifuso query()
 * @method static \Illuminate\Database\Eloquent\Builder|TgSubtemasDifuso whereIDSubtema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgSubtemasDifuso whereIDTema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgSubtemasDifuso whereValor($value)
 * @mixin \Eloquent
 */
class TgSubtemasDifuso extends Model
{
    protected $table = 'tg__subtemas_difusos';
    public $incrementing = false;
    public $timestamps = false;
    protected $casts = [
        'ID_Tema' => 'int',
        'ID_Subtema' => 'int',
        'valor' => 'float'
    ];
    protected $fillable = [
        'valor'
    ];
    public function tg_tema()
    {
        return $this->belongsTo(TgTema::class, 'ID_Tema');
    }
}
