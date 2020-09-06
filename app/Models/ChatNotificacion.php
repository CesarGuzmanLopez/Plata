<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatNotificaciones
 *
 * @property int $id
 * @property int $ID_Mensaje
 * @property int $ID_Conversacion
 * @property int $ID_Participante
 * @property bool $visto
 * @property bool $enviado
 * @property bool $recibido
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property ChatConversacione $chat_conversacione
 * @property ChatMensaje $chat_mensaje
 * @property ChatParticipante $chat_participante
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereIDConversacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereIDMensaje($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereIDParticipante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereRecibido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatNotificacion whereVisto($value)
 * @mixin \Eloquent
 */
class ChatNotificacion extends Model
{

    protected $table = 'chat__notificaciones';

    protected $casts = [
        'ID_Mensaje' => 'int',
        'ID_Conversacion' => 'int',
        'ID_Participante' => 'int',
        'visto' => 'bool',
        'enviado' => 'bool',
        'recibido' => 'bool'
    ];

    protected $fillable = [
        'ID_Mensaje',
        'ID_Conversacion',
        'ID_Participante',
        'visto',
        'enviado',
        'recibido'
    ];

    public function chat_conversacione()
    {
        return $this->belongsTo(ChatConversacione::class, 'ID_Conversacion');
    }

    public function chat_mensaje()
    {
        return $this->belongsTo(ChatMensaje::class, 'ID_Mensaje');
    }

    public function chat_participante()
    {
        return $this->belongsTo(ChatParticipante::class, 'ID_Participante');
    }
}
