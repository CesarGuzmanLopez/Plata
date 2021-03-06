<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TgTema
 *
 * @property string $Descripcion
 * @property int $id
 * @property string $Nombre
 * @property int|null $ID_Usuario_Creador
 * @property bool $Premium
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $user
 * @property Collection|IaTemasRecomendado[] $ia__temas_recomendados
 * @property Collection|IaTemasRevisado[] $ia__temas_revisados
 * @property Collection|ReactivosReactivo[] $reactivos__reactivos
 * @property Collection|TgCursoTemasDifuso[] $tg__curso_temas_difusos
 * @property Collection|TgSubtemasDifuso[] $tg__subtemas_difusos
 * @method TgTema first()
 * @package App\Models
 * @property-read int|null $ia__temas_recomendados_count
 * @property-read int|null $ia__temas_revisados_count
 * @property-read int|null $reactivos__reactivos_count
 * @property-read int|null $tg__curso_temas_difusos_count
 * @property-read int|null $tg__subtemas_difusos_count
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema query()
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema whereIDUsuarioCreador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema wherePremium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgTema whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TgTema extends Model
{
    /**
     * {@inheritDoc}
     * @see \Illuminate\Database\Eloquent\Model::__construct()
     */
    public function __invoke(){
            $temporal = new TgTema();

    }

    protected $table = 'tg__temas';

    protected $casts = [
        'ID_Usuario_Creador' => 'int',
        'Premium' => 'bool'
    ];

    protected $fillable = [
        'Nombre',
        'ID_Usuario_Creador',
        'Premium',
        'Descripcion'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_Creador');
    }

    public function ia__temas_recomendados()
    {
        return $this->hasMany(IaTemasRecomendado::class, 'ID_Tema_Recomendado');
    }

    public function ia__temas_revisados()
    {
        return $this->hasMany(IaTemasRevisado::class, 'ID_Tema_Visto');
    }

    public function reactivos__reactivos()
    {
        return $this->hasMany(ReactivosReactivo::class, 'ID_Tema');
    }

    public function tg__curso_temas_difusos()
    {
        return $this->hasMany(TgCursoTemasDifuso::class, 'ID_Tema');
    }

    public function tg__subtemas_difusos()
    {
        return $this->hasMany(TgSubtemasDifuso::class, 'ID_Tema');
    }
}
