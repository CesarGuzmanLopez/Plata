<?php

namespace App\Http\Controllers\getsTables;

use App\Http\Controllers\Controller;
use App\Models\TgCurso;
use Illuminate\Http\Request;
class Cursos extends Controller
{
    public function __invoke(){
        $Variables=['id','Nombre','Descripcion','Premium'];
        $inmutables=['id'];
        $tiposVariables=["int","string","text" ,"boolean"];
        return [$tiposVariables,$Variables,TgCurso::select($Variables)->get(),$inmutables];
    }
}
