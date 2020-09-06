<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MembresiasTiket
 *
 * @property int $id
 * @property string $Pago
 * @property string $llave
 * @property int|null $ID_Usuario_Acepta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Collection|MembresiasGrupo[] $membresias__grupos
 * @property Collection|MembresiasUsuario[] $membresias__usuarios
 * @package App\Models
 * @property-read int|null $membresias__grupos_count
 * @property-read int|null $membresias__usuarios_count
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket query()
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket whereIDUsuarioAcepta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket whereLlave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket wherePago($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembresiasTiket whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MembresiasTiket extends Model
{

    protected $table = 'membresias__tiket';

    protected $casts = [
        'ID_Usuario_Acepta' => 'int'
    ];

    protected $fillable = [
        'Pago',
        'llave',
        'ID_Usuario_Acepta'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_Acepta');
    }

    public function membresias__grupos()
    {
        return $this->hasMany(MembresiasGrupo::class, 'ID_tiket');
    }

    public function membresias__usuarios()
    {
        return $this->hasMany(MembresiasUsuario::class, 'ID_tiket');
    }
}
