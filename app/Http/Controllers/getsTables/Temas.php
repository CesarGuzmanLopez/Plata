<?php

namespace App\Http\Controllers\getsTables;

use App\Http\Controllers\Controller;
use App\Models\TgTema;
use Illuminate\Http\Request;
final class Temas extends Controller
{
    public function __invoke(){
        return TgTema::select('id','Nombre','Descripcion','Premium')->get();
    }
}
