<?php

namespace App\Http\Controllers\getsTables;

use App\Http\Controllers\Controller;
use App\Models\TgGradosAcademico;
use Illuminate\Http\Request;
final class Grados extends Controller
{
    public function __invoke(){
        $Variables=['id','Nombre'];
        $inmutables=['id'];
        $tiposVariables=["int","string"];
        return [$tiposVariables,$Variables,TgGradosAcademico::select($Variables)->get(),$inmutables];
    }
}
