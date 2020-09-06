<?php
namespace App\libs\GestionCurso;

use App\Models\TgTema;

/**
 *
 * @author Guzman Lopez Cesar Gerardo 88-8@live.com.mx
 *        
 */
interface AltaTema
{
    public function __construct();
    public function ___invoke(string $Nombre, string $tor):TgTema;

}