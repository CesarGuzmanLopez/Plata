<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatParticipante
 *
 * @property int $id
 * @property int $ID_Conversacion
 * @property string $Tipo_Mensaje
 * @property string $Configuracion
 * @property int|null $ID_Participante
 * @property ChatConversacione $chat_conversacione
 * @property User $user
 * @property Collection|ChatNotificacione[] $chat__notificaciones
 * @package App\Models
 * @property-read int|null $chat__notificaciones_count
 * @method static \Illuminate\Database\Eloquent\Builder|ChatParticipante newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatParticipante newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatParticipante query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatParticipante whereConfiguracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatParticipante whereIDConversacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatParticipante whereIDParticipante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatParticipante whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatParticipante whereTipoMensaje($value)
 * @mixin \Eloquent
 */
class ChatParticipante extends Model
{

    protected $table = 'chat__participantes';

    public $timestamps = false;

    protected $casts = [
        'ID_Conversacion' => 'int',
        'ID_Participante' => 'int'
    ];

    protected $fillable = [
        'ID_Conversacion',
        'Tipo_Mensaje',
        'Configuracion',
        'ID_Participante'
    ];

    public function chat_conversacione()
    {
        return $this->belongsTo(ChatConversacione::class, 'ID_Conversacion');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Participante');
    }
    
    public function chat__notificaciones()
    {
        return $this->hasMany(ChatNotificacion::class, 'ID_Participante');
    }
}
