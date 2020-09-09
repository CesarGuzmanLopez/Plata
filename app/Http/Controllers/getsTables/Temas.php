<?php

namespace App\Http\Controllers\getsTables;

use App\Http\Controllers\Controller;
use App\Models\TgTema;
use Illuminate\Http\Request;
final class Temas extends Controller
{
    public function __invoke(){
        $Variables=['id','Nombre','Descripcion','Premium'];
        $inmutables=['id'];
        $tiposVariables=["int","string","text" ,"boolean"];
        return [$tiposVariables,$Variables,TgTema::select($Variables)->get(),$inmutables];
    }
}
