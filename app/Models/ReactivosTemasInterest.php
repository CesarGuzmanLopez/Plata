<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosTemasInterest
 *
 * @property int $id
 * @property string $Tema
 * @property float $Popularidad
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|IaTemasIntere[] $ia__temas_interes
 * @property Collection|ReactivosReactivo[] $reactivos__reactivos
 * @package App\Models
 * @property-read int|null $ia__temas_interes_count
 * @property-read int|null $reactivos__reactivos_count
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosTemasInterest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosTemasInterest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosTemasInterest query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosTemasInterest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosTemasInterest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosTemasInterest wherePopularidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosTemasInterest whereTema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReactivosTemasInterest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReactivosTemasInterest extends Model
{

    protected $table = 'reactivos__temas_interest';

    protected $casts = [
        'Popularidad' => 'float'
    ];

    protected $fillable = [
        'Tema',
        'Popularidad'
    ];

    public function ia__temas_interes()
    {
        return $this->hasMany(IaTemasIntere::class, 'ID_Tema_Interes');
    }

    public function reactivos__reactivos()
    {
        return $this->hasMany(ReactivosReactivo::class, 'ID_Tema_Interes');
    }
}
